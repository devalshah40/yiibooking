<?php

class RoomsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
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
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create','update','admin','delete','search'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Rooms;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Rooms']))
		{
			$model->attributes=$_POST['Rooms'];
			if($model->save()) {
        		Yii::app()->user->setFlash('success', "New Room is added successfully.");
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Rooms']))
		{
			$model->attributes=$_POST['Rooms'];
			if ($model->save()) {
        Yii::app()->user->setFlash('success', "Room information is updated.");
        $this->redirect(array('view','id'=>$model->id));
      } else {
        Yii::app()->user->setFlash('error', "Please try again. Room information isn't updated.");
        $this->redirect(array('view','id'=>$model->id));
      }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
//		$dataProvider=new CActiveDataProvider('Rooms');
//		$this->render('index',array(
//			'dataProvider'=>$dataProvider,
//		));

    if (isset($_GET['pageSize'])) {
      Yii::app()->user->setState('pageSize',(int) $_GET['pageSize']);
    }
    $model=new Rooms('search');
    $model->unsetAttributes();  // clear any default values
    if(isset($_GET['Rooms']))
      $model->attributes=$_GET['Rooms'];

    $this->render('admin',array(
      'model'=>$model,
    ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{

    if (isset($_GET['pageSize'])) {
      Yii::app()->user->setState('pageSize',(int) $_GET['pageSize']);
    }

		$model=new Rooms('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Rooms']))
			$model->attributes=$_GET['Rooms'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Rooms the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Rooms::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Rooms $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='rooms-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

  /**
   * Displays the forgot password page
   */
  public function actionSearch() {
    $model = new AvailableroomForm();

    if (Yii::app()->request->isPostRequest) {
//      var_dump($_POST);
//      exit;
      $model->startDate = $_POST['AvailableroomForm']['startDate'];
      $model->endDate = $_POST['AvailableroomForm']['endDate'];
//      var_dump($model);exit;
      $bookings = $model->findRoomBookings();

      if (!empty($bookings)) {
//        var_dump($bookings);exit;
        foreach ($bookings as $booking) {
          $events[] = array(
            'title' => $booking['yatrik_name'],
            'start' => $booking['arrival_date'],
            'end' => date('Y-m-d', strtotime('0 day',strtotime($booking['departure_date']))),
            'url' => $this->createUrl('booking/view',array('id' => $booking['booking_id']))
          );
        }
      }
      echo CJSON::encode($events);
    }

    $this->render('search', array('model' => $model));
  }
}
