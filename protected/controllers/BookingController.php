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
        'actions' => array('index', 'view'),
        'users' => array('*'),
      ),
      array('allow', // allow authenticated user to perform 'create' and 'update' actions
        'actions' => array('create', 'update'),
        'users' => array('@'),
      ),
      array('allow', // allow admin user to perform 'admin' and 'delete' actions
        'actions' => array('admin', 'delete'),
        'users' => array('admin'),
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
    $this->loadModel($id)->delete();

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

    if(Yii::app()->request->getParam('export')) {
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
    $fp = fopen('php://temp', 'w');
 
    /* 
     * Write a header of csv file
     */
    $headers = array(
        'Booking ID',
        'Yatrik Name',
        'City',
        'Pincode',
        'Pincode',
        'Mobile No',
        'Email',
        'Rooms',
        'Arrival Date',
        'Departure Date',
        'Receipt No',
        'Deposit Amount',
        'Actual Amount',
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
 
    /*
     * Get models, write to a file, then change page and re-init DataProvider
     * with next page and repeat writing again
     */
    while($models = $dp->getData()) {
        foreach($models as $model) {
            $row = array();
            foreach($headers as $head) {
                $row[] = CHtml::value($model,$head);
            }
            fputcsv($fp,$row);
        }
 
        unset($model,$dp,$pg);
        $model=new MODEL('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['MODEL']))
            $model->attributes=$_GET['MODEL'];
 
        $dp = $model->search();
        $nextPage = $dp->getPagination()->getCurrentPage()+1;
        $dp->getPagination()->setCurrentPage($nextPage);
    }
 
    /*
     * save csv content to a Session
     */
    rewind($fp);
    Yii::app()->user->setState('export',stream_get_contents($fp));
    fclose($fp);
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

}
