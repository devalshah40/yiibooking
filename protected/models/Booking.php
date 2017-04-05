<?php

/**
 * This is the model class for table "booking".
 *
 * The followings are the available columns in table 'booking':
 * @property integer $id
 * @property string $yatrik_name
 * @property string $address
 * @property string $city
 * @property string $pincode
 * @property string $mobile_no
 * @property string $email
 * @property string $arrival_date
 * @property string $departure_date
 * @property string $receipt_no
 * @property string $deposit_amount
 * @property string $actual_amount
 * @property string $notes
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 *
 *
 * The followings are the available model relations:
 * @property Users $createdBy
 * @property Users $updatedBy
 * @property BookingDetails[] $bookingDetails
 */
class Booking extends CActiveRecord {

  public $dateRange;
  public $startDate;
  public $endDate;
  public $noOfRooms;
  public $rooms;

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return 'booking';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
      array('yatrik_name, address, city, pincode, mobile_no, email, arrival_date, departure_date, receipt_no, deposit_amount, actual_amount', 'required'),
      array('arrival_date, departure_date', 'date', 'format' => array('yyyy-MM-dd')),
      array('mobile_no, pincode, receipt_no', 'numerical', 'integerOnly' => true),
      array('deposit_amount, actual_amount', 'numerical'),
      array('mobile_no', 'length', 'min' => 10, 'max' => 10),
      array('email', 'email'),
      array('yatrik_name, city, mobile_no, email, receipt_no', 'length', 'max' => 255),
      array('pincode', 'length', 'max' => 7),
      array('deposit_amount, actual_amount', 'length', 'max' => 10),
      array('address, notes,rooms,noOfRooms', 'safe'),
      // The following rule is used by search().
      // @todo Please remove those attributes that should not be searched.
      array('id, yatrik_name, address, city, pincode, mobile_no, email, arrival_date, departure_date, receipt_no, deposit_amount, actual_amount, notes, created_date, created_by, updated_date, updated_by', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
      'booking_details' => array(self::HAS_MANY, 'BookingDetails', 'booking_id'),
      'created' => array(self::BELONGS_TO, 'User', 'created_by'),
      'updated' => array(self::BELONGS_TO, 'User', 'updated_by'),
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
      'id' => 'Booking ID',
      'yatrik_name' => 'Yatrik Name',
      'address' => 'Address',
      'city' => 'City',
      'pincode' => 'Pincode',
      'mobile_no' => 'Mobile No',
      'email' => 'Email',
      'arrival_date' => 'Arrival Date',
      'departure_date' => 'Departure Date',
      'receipt_no' => 'Receipt No',
      'deposit_amount' => 'Deposit Amount',
      'actual_amount' => 'Actual Amount',
      'notes' => 'Notes',
      'created_date' => 'Created Date',
      'created_by' => 'Created By',
      'updated_date' => 'Updated Date',
      'updated_by' => 'Updated By',
    );
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

    $criteria->compare('id', $this->id);
    $criteria->compare('yatrik_name', $this->yatrik_name, true);
    $criteria->compare('address', $this->address, true);
    $criteria->compare('city', $this->city, true);
    $criteria->compare('pincode', $this->pincode, true);
    $criteria->compare('mobile_no', $this->mobile_no, true);
    $criteria->compare('email', $this->email, true);
    $criteria->compare('arrival_date', $this->arrival_date, true);
    $criteria->compare('departure_date', $this->departure_date, true);
    $criteria->compare('receipt_no', $this->receipt_no, true);
    $criteria->compare('deposit_amount', $this->deposit_amount, true);
    $criteria->compare('actual_amount', $this->actual_amount, true);
    $criteria->compare('notes', $this->notes, true);
    $criteria->compare('created_date', $this->created_date, true);
    $criteria->compare('created_by', $this->created_by);
    $criteria->compare('updated_date', $this->updated_date, true);
    $criteria->compare('updated_by', $this->updated_by);

    return new CActiveDataProvider($this, array(
      'criteria' => $criteria,
    ));
  }

  /**
   * Returns the static model of the specified AR class.
   * Please note that you should have this exact method in all your CActiveRecord descendants!
   * @param string $className active record class name.
   * @return Booking the static model class
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
        $this->created_date = $this->updated_date = date('Y-m-d');
        $this->created_by = Yii::app()->user->id;
      } else {
        $this->updated_by = Yii::app()->user->id;
        $this->updated_date = date('Y-m-d');
      }
      return true;
    } else
      return false;
  }

  public function afterFind() {
    $this->dateRange = date('d-m-Y',strtotime($this->arrival_date)) .' - ' . date('d-m-Y',strtotime($this->departure_date));

    foreach ($this->booking_details as $bookingDetails) {
      $this->noOfRooms[] = $bookingDetails->number_count;
      $this->rooms[] = $bookingDetails->room_id;
    }
    return true;
  }

  /**
   * Logs in the user using the given username and password in the model.
   * @return boolean whether login is successful
   */
  public function saveBooking() {
    $connection = Yii::app()->db;
    $loginUserID = Yii::app()->user->id;
    $transaction = $connection->beginTransaction();
    try {
      $sql = "INSERT INTO `booking` (
              `yatrik_name`,
              `address`,
              `city`,
              `pincode`,
              `mobile_no`,
              `email`,
              `arrival_date`,
              `departure_date`,
              `receipt_no`,
              `deposit_amount`,
              `actual_amount`,
              `notes`,
              `created_date`,
              `created_by`,
              `updated_date`,
              `updated_by`
            )
            VALUES
            (
              :yatrik_name,
              :address,
              :city,
              :pincode,
              :mobile_no,
              :email,
              :arrival_date,
              :departure_date,
              :receipt_no,
              :deposit_amount,
              :actual_amount,
              :notes,
              :created_date,
              :created_by,
              :updated_date,
              :updated_by
            )";
      $command = $connection->createCommand($sql);
      $command->bindParam(":yatrik_name", $this->yatrik_name, PDO::PARAM_STR);
      $command->bindParam(':address', $this->address, PDO::PARAM_STR);
      $command->bindParam(':city', $this->city, PDO::PARAM_STR);
      $command->bindParam(':pincode', $this->pincode, PDO::PARAM_INT);
      $command->bindParam(':mobile_no', $this->mobile_no, PDO::PARAM_INT);
      $command->bindParam(':email', $this->email, PDO::PARAM_STR);
      $command->bindParam(':arrival_date', $this->arrival_date, PDO::PARAM_STR);
      $command->bindParam(':departure_date', $this->departure_date, PDO::PARAM_STR);
      $command->bindParam(':receipt_no', $this->receipt_no, PDO::PARAM_STR);
      $command->bindParam(':deposit_amount', $this->deposit_amount, PDO::PARAM_INT);
      $command->bindParam(':actual_amount', $this->actual_amount, PDO::PARAM_INT);
      $command->bindParam(':notes', $this->notes, PDO::PARAM_STR);
      $command->bindParam(':created_date', date('Y-m-d'), PDO::PARAM_STR);
      $command->bindParam(':created_by', $loginUserID, PDO::PARAM_INT);
      $command->bindParam(':updated_date', date('Y-m-d'), PDO::PARAM_STR);
      $command->bindParam(':updated_by', $loginUserID, PDO::PARAM_INT);
      $command->execute();

      $booking_id = $connection->getLastInsertID();

      $sql = "INSERT INTO `booking_details` (
                `booking_id`,
                `room_id`,
                `number_count`
            )
            VALUES
            (
              :booking_id,
              :room_id,
              :number_count
            )";
      $command = $connection->createCommand($sql);

      foreach ($this->rooms as $key => $room) {
        $command->bindValues(array(
          'booking_id' => $booking_id,
          'room_id' => $room,
          'number_count' => $this->noOfRooms[$key]
        ));
        $command->execute();
      }
      $transaction->commit();
      return true;
    } catch (Exception $e) // an exception is raised if a query fails
    {
      $transaction->rollback();
      return false;
    }
  }
}
