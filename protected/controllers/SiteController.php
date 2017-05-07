<?php

class SiteController extends Controller {
  /**
   * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
   * using two-column layout. See 'protected/views/layouts/column2.php'.
   */
  public $layout = '//layouts/column2';

  /**
   * @return array action filters
   */
  public function filters() {
    return CMap::mergeArray(parent::filters(), array(
      'accessControl', // perform access control for CRUD operations
    ));
  }


  /**
   * Specifies the access control rules.
   * This method is used by the 'accessControl' filter.
   * @return array access control rules
   */
  public function accessRules() {
    return array(
      array('allow',  // allow all users to perform 'index' and 'view' actions
        'actions' => array('error', 'login', 'forgot', 'contact'),
        'users' => array('*'),
      ),
      array('allow', // allow authenticated users to access all actions
        'users' => array('@'),
      ),
      array('deny',  // deny all users
        'users' => array('*'),
      ),
    );
  }

  /**
   * Declares class-based actions.
   */
  public function actions() {
    return array(
      // captcha action renders the CAPTCHA image displayed on the contact page
      'captcha' => array(
        'class' => 'CCaptchaAction',
        'backColor' => 0xFFFFFF,
      ),
      // page action renders "static" pages stored under 'protected/views/site/pages'
      // They can be accessed via: index.php?r=site/page&view=FileName
      'page' => array(
        'class' => 'CViewAction',
      ),
    );
  }

  /**
   * This is the default 'index' action that is invoked
   * when an action is not explicitly requested by users.
   */
  public function actionIndex() {
    // renders the view file 'protected/views/site/index.php'
    // using the default layout 'protected/views/layouts/main.php'
    $this->redirect(array('booking/admin'));
    $this->render('index');
  }

  /**
   * This is the action to handle external exceptions.
   */
  public function actionError() {
    if ($error = Yii::app()->errorHandler->error) {
      if (Yii::app()->request->isAjaxRequest)
        echo $error['message'];
      else
        $this->render('error', $error);
    }
  }

  /**
   * Displays the contact page
   */
  public function actionContact() {
    $model = new ContactForm;
    if (isset($_POST['ContactForm'])) {
      $model->attributes = $_POST['ContactForm'];
      if ($model->validate()) {
        $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
        $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
        $headers = "From: $name <{$model->email}>\r\n" .
          "Reply-To: {$model->email}\r\n" .
          "MIME-Version: 1.0\r\n" .
          "Content-Type: text/plain; charset=UTF-8";

        mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
        Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
        $this->refresh();
      }
    }
    $this->render('contact', array('model' => $model));
  }

  /**
   * Displays the login page
   */
  public function actionLogin() {
    $this->layout = '//layouts/login';

    $model = new LoginForm;

    // if it is ajax validation request
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }

    // collect user input data
    if (isset($_POST['LoginForm'])) {
      $model->attributes = $_POST['LoginForm'];
      // validate user input and redirect to the previous page if valid
      if ($model->validate() && $model->login())
        $this->redirect(Yii::app()->user->returnUrl);
    }
    // display the login form
    $this->render('login', array('model' => $model));
  }

  /**
   * Displays the forgot password page
   */
  public function actionForgot() {
    $this->layout = '//layouts/login';

    $model = new ForgotForm();

    if (Yii::app()->request->isAjaxRequest) {

      if (Yii::app()->request->getPost('ForgotForm')) {
        $model->attributes = Yii::app()->request->getPost('ForgotForm');
        if ($model->validate() && $model->reset()) {
          echo 'Further instructions have been sent to you email';
        } else {
          if ($model->getError('email')) {
            echo $model->getError('email');
          } elseif ($model->getError('verifyCode')) {
            echo $model->getError('verifyCode');
          }
        }
      }

    } else {
      $this->render('forgot', array('model' => $model));
    }

  }

  /**
   * Displays the forgot password page
   */
  public function actionCalendar() {
    $model = new SearchForm();

    if (Yii::app()->request->isAjaxRequest) {
//      $model->dateRange = date('01-m-Y') ." - " . date('t-m-Y');
      $model->startDate = Yii::app()->request->getPost('start');
      $model->endDate = Yii::app()->request->getPost('end');


      $roomsResult = Rooms::model()->findAll(array(
        'condition' => 'room_status=:status',
        'params' => array(':status' => 1)
      ));

      $rooms = array();
      foreach ($roomsResult as $room) {
        $room_count = $room->room_count;
        $room_name = $room->room_name;
        $rooms[$room->id] = array(
          'room_count' => $room_count,
          'room_name' => $room_name
        );
      }

      $begin = new DateTime( $model->startDate );
      $end = new DateTime( $model->endDate );

      $availableRooms = array();
      for($i = $begin; $i <= $end; $i->modify('+1 day')){
        $booked_date = $i->format("Y-m-d");
        $availableRooms[$booked_date] = $rooms;
      }

######################################################################
      $bookings = $model->searchBookings();

      $events = array();
      if (!empty($bookings)) {
//        var_dump($bookings);exit;
        foreach ($bookings as $booking) {

          $begin = new DateTime( $booking['arrival_date'] );
          $end = new DateTime( $booking['departure_date'] );

          for($i = $begin; $i < $end; $i->modify('+1 day')){
            $booked_date = $i->format("Y-m-d");
            $roomsBooked = &$availableRooms[$booked_date][$booking['room_id']];
            $roomsBooked['room_count'] -= $booking['number_count'];
          }
//          'title' => $booking['yatrik_name'],
          $events[] = array(
            'title' => $booking['yatrik_name'] .' - '.$booking['room_details'],
            'start' => $booking['arrival_date'],
            'end' => $booking['departure_date'],
            'url' => $this->createUrl('booking/view',array('id' => $booking['booking_id'])),
            'color' => 'green'
          );
        }
      }
//      $events = array_values($events);

      foreach ($availableRooms as $date => $availableRoom) {
        foreach ($availableRoom as $room) {
          if($room['room_count'] > 0) {
            $events[] = array(
              'title' => $room['room_count'] .' '. $room['room_name'],
              'start' => $date,
              'end' => date("Y-m-d", strtotime($date)+86400),
              'color' => 'orange'
            );
          }
        }
      }
      echo CJSON::encode($events);
    } else {
      $this->render('calendar', array('model' => $model));
    }
  }

  /**
   * Logs out the current user and redirect to homepage.
   */
  public function actionLogout() {
    Yii::app()->user->logout();
    $this->redirect(Yii::app()->homeUrl);
  }
}