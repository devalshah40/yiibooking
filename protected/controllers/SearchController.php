<?php

class SearchController extends Controller {
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
//      array('allow',  // allow all users to perform 'index' and 'view' actions
//        'actions' => array('error', 'login', 'forgot', 'contact'),
//        'users' => array('*'),
//      ),
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
    $model = new SearchForm();
    $booking = new Booking();

    // if it is ajax validation request
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'search-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }

    // collect user input data
    if (isset($_POST['SearchForm'])) {
      $model->attributes = $_POST['SearchForm'];
      // validate user input and redirect to the previous page if valid
      if ($model->validate() && $model->findRooms()) {
      }
    }

    $this->render('index', array('model' => $model,'bookingModel' => $booking));
  }


  /**
   * This is the default 'index' action that is invoked
   * when an action is not explicitly requested by users.
   */
  public function actionBooking() {
    // renders the view file 'protected/views/site/index.php'
    // using the default layout 'protected/views/layouts/main.php'
    $model = new SearchForm();
    $booking = new Booking();

    // collect user input data
    if (isset($_POST['Booking'])) {
      $model->attributes = $_POST['Booking'];
      $booking->attributes = $_POST['Booking'];
//      var_dump($_POST['Booking']);
//      var_dump($model);
//      var_dump($booking);
//      exit;
      // validate user input and redirect to the previous page if valid
      if ($model->validate() && $model->findRooms() && !$model->hasErrors() && $booking->validate() && ($booking_id = $booking->saveBooking())) {
        $this->redirect(array('/booking/view','id' => $booking_id));
      }
    }

    $this->render('index', array('model' => $model,'bookingModel' => $booking));
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
  public function actionSearch() {

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
    $this->render('index', array('model' => $model));
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
   * Logs out the current user and redirect to homepage.
   */
  public function actionLogout() {
    Yii::app()->user->logout();
    $this->redirect(Yii::app()->homeUrl);
  }
}