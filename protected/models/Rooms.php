<?php

/**
 * This is the model class for table "rooms".
 *
 * The followings are the available columns in table 'rooms':
 * @property integer $id
 * @property string $room_name
 * @property string $room_price
 * @property string $room_info
 * @property integer $room_count
 * @property integer $room_capacity
 * @property integer $room_status
 * @property string $created_date
 * @property string $updated_date
 */
class Rooms extends CActiveRecord {
  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return 'rooms';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
      array('room_name, room_price, room_capacity, room_count', 'required'),
      array('room_capacity, room_status, room_count', 'numerical', 'integerOnly' => true, 'min'=>1),
      array('room_price', 'numerical', 'min'=>1),
      array('room_name', 'length', 'max' => 255),
      array('room_price', 'length', 'max' => 10),
      array('room_info', 'safe'),
      // The following rule is used by search().
      // @todo Please remove those attributes that should not be searched.
      array('room_name, room_price, room_info, room_capacity, room_count, room_status, created_date, updated_date', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
      'booking_details' => array(self::HAS_MANY, 'BookingDetails', 'room_id'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
      'room_name' => 'Room Name',
      'room_price' => 'Room Price',
      'room_info' => 'Room Info',
      'room_capacity' => 'Room Capacity',
      'room_count' => 'No of Rooms',
      'room_status' => 'Room Status',
      'created_date' => 'Created Date',
      'updated_date' => 'Updated Date',
    );
  }

  /**
   * @return string the URL that shows the detail of the post
   */
  public function getUrl() {
    return Yii::app()->createUrl('rooms/view', array(
      'id' => $this->id
    ));
  }

  /**
   * Retrieves a list of models based on the current search/filter conditions.
   *
   * Typical usecase:
   * - Initialize the model fields with values from filter form.
   * - Execute this method to get CActiveDataProvider instance which will filter
   * models according to data in model fields.
   * - Pass data provider to CGridView, CListView or any similar widget.
   *
   * @return CActiveDataProvider the data provider that can return the models
   * based on the search/filter conditions.
   */
  public function search() {
    // @todo Please modify the following code to remove attributes that should not be searched.

    $criteria = new CDbCriteria;

    $criteria->compare('room_name', $this->room_name, true);
    $criteria->compare('room_price', $this->room_price, true);
    $criteria->compare('room_info', $this->room_info, true);
    $criteria->compare('room_count', $this->room_count);
    $criteria->compare('room_capacity', $this->room_capacity);
    $criteria->compare('room_status', $this->room_status);
    $criteria->compare('created_date', $this->created_date, true);
    $criteria->compare('updated_date', $this->updated_date, true);

    $pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);

    return new CActiveDataProvider($this, array(
      'criteria' => $criteria,
      'pagination' => array(
        'pageSize' => $pageSize,
        'pageVar' => '#example1_paginate',
      )
    ));
  }

  /**
   * Returns the static model of the specified AR class.
   * Please note that you should have this exact method in all your CActiveRecord descendants!
   * @param string $className active record class name.
   * @return Rooms the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * This is invoked before the record is saved.
   * @return boolean whether the record should be saved.
   */
  protected function beforeSave() {
    if (parent::beforeSave()) {
      if ($this->isNewRecord) {
        $this->created_date = $this->updated_date = date('Y-m-d H:i:s');
      } else {
        $this->updated_date = date('Y-m-d H:i:s');
      }
      return true;
    } else
      return false;
  }

  public static function getRooms() {
    $rooms = array();
    $models = self::model()->findAll(array(
      'condition' => 'room_status=:status',
      'params' => array(':status' => 1)
    ));
    foreach ($models as $model)
      $rooms[$model->id] = $model->room_name;
    return $rooms;
  }
}
