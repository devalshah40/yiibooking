<?php

class BookingController extends Controller {
  /**
   * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
   * using two-column layout. See 'protected/views/layouts/column2.php'.
   */
  public $layout = '//layouts/column2';

  /**
   * @return array action filters
   */
  public function filters() {
    return array(
      'accessControl', // perform access control for CRUD operations
      'postOnly + delete', // we only allow deletion via POST request
    );
  }

  /**
   * Specifies the access control rules.
   * This method is used by the 'accessControl' filter.
   * @return array access control rules
   */
  public function accessRules() {
    return array(
      array('allow',  // allow all users to perform 'index' and 'view' actions
        'actions' => array('index', 'view','create', 'update','admin', 'delete','exportfile'),
        'users' => array('@'),
      ),
      array('deny',  // deny all users
        'users' => array('*'),
      ),
    );
  }

  /**
   * Displays a particular model.
   * @param integer $id the ID of the model to be displayed
   */
  public function actionView($id) {
    $this->render('view', array(
      'model' => $this->loadModel($id),
    ));
  }

  /**
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   */
  public function actionCreate() {
    $model = new Booking;

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if (isset($_POST['Booking'])) {
      $model->attributes = $_POST['Booking'];
      if ($model->save())
        $this->redirect(array('view', 'id' => $model->id));
    }

    $this->render('create', array(
      'model' => $model,
    ));
  }

  /**
   * Updates a particular model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id the ID of the model to be updated
   */
  public function actionUpdate($id) {
    $model = $this->loadModel($id);
    if(!(Yii::app()->user->id == 1 || $model->created_by == Yii::app()->user->id)) {
      Yii::app()->user->setFlash('error', "You don't have rights to update other User's booking.");
      $this->redirect(array('admin'));
    }

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if (isset($_POST['Booking'])) {
      $oldNoOfRooms = $model->noOfRooms;
      $oldRooms = $model->rooms;

      $model->attributes = $_POST['Booking'];
//      var_dump($oldNoOfRooms);
//      var_dump($oldRooms);
//
//      $searchedRooms = array();
//      foreach ($oldNoOfRooms as $key => $oldNoOfRoom) {
//        $searchedRooms[$oldRooms[$key]] = $oldNoOfRoom;
//      }

//      var_dump($model);
//      exit;
      if ($model->save()) {
        Yii::app()->user->setFlash('success', "Booking information is updated.");
        $this->redirect(array('view','id'=>$model->id));
      } else {
        Yii::app()->user->setFlash('error', "Please try again. Booking information isn't updated.");
        $this->redirect(array('view','id'=>$model->id));
      }
    }

    $this->render('update', array(
      'model' => $model,
    ));
  }

  /**
   * Deletes a particular model.
   * If deletion is successful, the browser will be redirected to the 'admin' page.
   * @param integer $id the ID of the model to be deleted
   */
  public function actionDelete($id) {
    $model = $this->loadModel($id);

    if(!(Yii::app()->user->id == 1 || $model->created_by == Yii::app()->user->id)) {
      Yii::app()->user->setFlash('error', "You don't have rights to delete other User's booking.");
      $this->redirect(array('admin'));
    }

    $model->delete();
    Yii::app()->user->setFlash('success', "Booking information is deleted.");
    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
    if (!isset($_GET['ajax']))
      $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
  }

  /**
   * Lists all models.
   */
  public function actionIndex() {
    /*$dataProvider = new CActiveDataProvider('Booking');
    $this->render('index', array(
      'dataProvider' => $dataProvider,
    ));*/
    if (isset($_GET['pageSize'])) {
      Yii::app()->user->setState('pageSize',(int) $_GET['pageSize']);
    }

    $model = new Booking('search');
    $model->unsetAttributes();  // clear any default values
    if (isset($_GET['Booking']))
      $model->attributes = $_GET['Booking'];

    $this->render('admin', array(
      'model' => $model,
    ));
  }

  /**
   * Manages all models.
   */
  public function actionAdmin() {

    if (isset($_GET['pageSize'])) {
      Yii::app()->user->setState('pageSize',(int) $_GET['pageSize']);
    }

    if(isset($_GET['export'])) {
        $this->actionExport();
        Yii::app()->end();
    }

    $model = new Booking('search');
    $model->unsetAttributes();  // clear any default values
    if (isset($_GET['Booking']))
      $model->attributes = $_GET['Booking'];

    $this->render('admin', array(
      'model' => $model,
    ));
  }


  public function actionExport()
  {
    // disable caching
//    $now       = gmdate("D, d M Y H:i:s");
//    $filename  = "booking_export.csv";
//
//    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
//    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
//    header("Last-Modified: {$now} GMT");
//
//    // force download
//    header("Content-Type: application/force-download");
//    header("Content-Type: application/octet-stream");
//    header("Content-Type: application/download");
//
//    // disposition / encoding on response body
//    header("Content-Disposition: attachment;filename={$filename}");
//    header("Content-Transfer-Encoding: binary");

    $fp = fopen('php://temp', 'w');
//    $fp = fopen("php://output", 'w');
//    ob_start();
    /* 
     * Write a header of csv file
     */
    $headers = array(
        'Booking ID',
        'Yatrik Name',
        'City',
        'Mobile No',
        'Email',
        'Arrival Date',
        'Departure Date',
        'Rooms',
        'Receipt No',
        'Deposit Amount',
        'Actual Amount',
//        'Rooms',
        'Created Date',
        'Created By'
    );

    fputcsv($fp,$headers);
 
    /*
     * Init dataProvider for first page
     */
    $model=new Booking('search');
    $model->unsetAttributes();  // clear any default values
    if(isset($_GET['Booking'])) {
        $model->attributes=$_GET['Booking'];
    }
    $dp = $model->search();
    $dp->setPagination(false);
    /*
     * Get models, write to a file, then change page and re-init DataProvider
     * with next page and repeat writing again
     */
    $models = $dp->getData();
//      var_dump($models);
//      exit;
    foreach($models as $model) {

        $row = array();
        $row[] = $model->id;
        $row[] = $model->yatrik_name;
        $row[] = $model->city;
        $row[] = $model->mobile_no;
        $row[] = $model->email;
        $row[] = date('d-m-Y', strtotime($model->arrival_date));
        $row[] = date('d-m-Y', strtotime($model->departure_date));

//            foreach($model->booking_details as $key => $booking_details) {
//                  var_dump($booking_details);exit;
//            }
        $booked_room_details = array();
        foreach ($model->booking_details as $bookingDetails) {
          $booked_room_details[] = $bookingDetails->number_count . " ". $bookingDetails->room->room_name;
        }
        $row[] = implode(',', $booked_room_details);

        $row[] = $model->receipt_no;
        $row[] = $model->deposit_amount;
        $row[] = $model->actual_amount;
        $row[] = date('d-m-Y', strtotime($model->created_date));
        $row[] = $model->created->name;

        fputcsv($fp,$row);
    }

    /*
     * save csv content to a Session
     */
    rewind($fp);
    Yii::app()->user->setState('export',stream_get_contents($fp));
    fclose($fp);

//    Yii::app()->user->setState('export',ob_get_clean());
  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer $id the ID of the model to be loaded
   * @return Booking the loaded model
   * @throws CHttpException
   */
  public function loadModel($id) {
    $model = Booking::model()->with('created','booking_details.room','updated')->findByPk($id);
//    var_dump($model->created->name);
//    var_dump($model->booking_details);
//    exit;
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  /**
   * Performs the AJAX validation.
   * @param Booking $model the model to be validated
   */
  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'booking-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }

  public function actionExportfile()
  {

    // disable caching
    $now       = gmdate("D, d M Y H:i:s");
    $filename  = "booking_export.csv";

    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");

    Yii::app()->request->sendFile($filename,Yii::app()->user->getState('export'));
    Yii::app()->user->clearState('export');
  }
}
