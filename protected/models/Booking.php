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
  public $noOfDays;
  public $rooms;
  public $roomsPrices;
  public $searchRooms;

  public $id;
  public $yatrik_name;
  public $address;
  public $city;
  public $pincode;
  public $mobile_no;
  public $email;
  public $arrival_date;
  public $departure_date;
  public $receipt_no;
  public $deposit_amount;
  public $actual_amount;
  public $notes;
  public $created_date;
  public $created_by;
  public $updated_date;
  public $updated_by;

  public $arrival_from_date;
  public $arrival_to_date;
  public $departure_from_date;
  public $departure_to_date;
  public $created_from_date;
  public $created_to_date;

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
      array(
        'deposit_amount',
        'compare',
        'compareAttribute' => 'actual_amount',
        'operator' => '<=',
        'allowEmpty' => false,
        'message' => 'Deposit amount must be less than or equal to Actual amount".'
      ),
      array('address, notes,rooms,noOfRooms, arrival_from_date, arrival_to_date, departure_from_date, departure_to_date, created_from_date, created_to_date,', 'safe'),
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
   * @return string the URL that shows the detail of the post
   */
  public function getUrl() {
    return Yii::app()->createUrl('booking/view', array(
      'id' => $this->id
    ));
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

    $criteria->with = array('created', 'booking_details.room', 'updated');

    $criteria->compare('id', $this->id);
    $criteria->compare('yatrik_name', $this->yatrik_name, true);
    $criteria->compare('address', $this->address, true);
    $criteria->compare('city', $this->city, true);
    $criteria->compare('pincode', $this->pincode, true);
    $criteria->compare('mobile_no', $this->mobile_no, true);
    $criteria->compare('email', $this->email, true);
    $criteria->compare('receipt_no', $this->receipt_no, true);
    $criteria->compare('deposit_amount', $this->deposit_amount, true);
    $criteria->compare('actual_amount', $this->actual_amount, true);
    $criteria->compare('notes', $this->notes, true);
    $criteria->compare('created_by', $this->created_by);
    $criteria->compare('updated_date', $this->updated_date, true);
    $criteria->compare('updated_by', $this->updated_by);

    if (!empty($this->arrival_from_date)) {
      $criteria->addCondition('arrival_date >= "'.date('Y-m-d', strtotime($this->arrival_from_date)).'" ');
    }
    if (!empty($this->arrival_to_date)) {
      $criteria->addCondition('arrival_date <= "'.date('Y-m-d', strtotime($this->arrival_to_date)).'" ');
    }
    if (!empty($this->departure_from_date)) {
      $criteria->addCondition('departure_date >= "'.date('Y-m-d', strtotime($this->departure_from_date)).'" ');
    }
    if (!empty($this->departure_to_date)) {
      $criteria->addCondition('departure_date <= "'.date('Y-m-d', strtotime($this->departure_to_date)).'" ');
    }
    if (!empty($this->created_from_date)) {
      $criteria->addCondition('created_date >= "'.date('Y-m-d', strtotime($this->created_from_date)).'" ');
    }
    if (!empty($this->created_to_date)) {
      $criteria->addCondition('created_date <= "'.date('Y-m-d', strtotime($this->created_to_date)).'" ');
    }

    if (!empty($this->arrival_date)) {
      $criteria->compare('arrival_date', date('Y-m-d', strtotime($this->arrival_date)), true);
    }
    if (!empty($this->departure_date)) {
      $criteria->compare('departure_date', date('Y-m-d', strtotime($this->departure_date)), true);
    }
    if (!empty($this->created_date)) {
      $criteria->compare('created_date', date('Y-m-d', strtotime($this->created_date)), true);
    }

    $pageSize = Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']);
    return new CActiveDataProvider($this, array(
      'criteria' => $criteria,
      'sort' => array(
        'defaultOrder' => array(
          'id' => true
        ),
      ),
      'pagination' => array(
        'pageSize' => $pageSize,
      ),
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
    $this->startDate = date('Y-m-d', strtotime($this->arrival_date));
    $this->endDate = date('Y-m-d', strtotime($this->departure_date));

    $this->dateRange = $this->startDate . ' - ' . $this->endDate;

    $date1 = new DateTime($this->startDate);
    $date2 = new DateTime($this->endDate);

    $this->noOfDays = $date2->diff($date1)->format("%a");

    foreach ($this->booking_details as $bookingDetails) {
      $this->noOfRooms[] = $bookingDetails->number_count;
      $this->rooms[] = $bookingDetails->room_id;
//      $this->roomsPrices[] = $bookingDetails->room_price;
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
      $created_date = date('Y-m-d H:i:s');
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
      $command->bindParam(':created_date', $created_date, PDO::PARAM_STR);
      $command->bindParam(':created_by', $loginUserID, PDO::PARAM_INT);
      $command->bindParam(':updated_date', $created_date, PDO::PARAM_STR);
      $command->bindParam(':updated_by', $loginUserID, PDO::PARAM_INT);
      $command->execute();

      $booking_id = $connection->getLastInsertID();
      $this->id = $booking_id;

      $sql = "INSERT INTO `booking_details` (
                `booking_id`,
                `room_id`,
                `number_count`,
                `room_price`
            )
            VALUES
            (
              :booking_id,
              :room_id,
              :number_count,
              :room_price
            )";
      $command = $connection->createCommand($sql);

      foreach ($this->rooms as $key => $room) {
        $roomObj = Rooms::model()->findByPk($room);
        $command->bindValues(array(
          'booking_id' => $booking_id,
          'room_id' => $room,
          'number_count' => $this->noOfRooms[$key],
          'room_price' => $roomObj->room_price
        ));
        $command->execute();
      }
      $transaction->commit();

      Yii::app()->user->setFlash('success', "Booking is successfully done.");
      return $booking_id;
    } catch (Exception $e) // an exception is raised if a query fails
    {
      $transaction->rollback();
      return false;
    }
  }

  public function sendMail(){
    Yii::app()->mailer->IsSMTP(); // telling the class to use SMTP
//        Yii::app()->mailer->Host       = "smtp.gmail.com"; // SMTP server
//        Yii::app()->mailer->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
    // 1 = errors and messages
    // 2 = messages only
    Yii::app()->mailer->SMTPAuth   = true;                  // enable SMTP authentication
    Yii::app()->mailer->SMTPSecure = "tls";                 // sets the prefix to the servier
    Yii::app()->mailer->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
    Yii::app()->mailer->Port       = 587;                   // set the SMTP port for the GMAIL server
    Yii::app()->mailer->Username   = "devalshah21@gmail.com";  // GMAIL username
    Yii::app()->mailer->Password   = "Kangana!@#";            // GMAIL password

//        Yii::app()->mailer->SetFrom('name@yourdomain.com', 'First Last');
//
//        Yii::app()->mailer->AddReplyTo("name@yourdomain.com","First Last");
//
//        Yii::app()->mailer->Subject    = "PHPMailer Test Subject via smtp (Gmail), basic";
//
//        Yii::app()->mailer->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
//
//        Yii::app()->mailer->MsgHTML($body);

//        $address = "whoto@otherdomain.com";
//        Yii::app()->mailer->AddAddress($address, "John Doe");
//
//        Yii::app()->mailer->AddAttachment("images/phpmailer.gif");      // attachment
//        Yii::app()->mailer->AddAttachment("images/phpmailer_mini.gif"); // attachment

    $users = User::model()->findByAttributes(array('status' => 1));
    var_dump($users);exit;

    Yii::app()->mailer->From = Yii::app()->params['replyToEmail'];
    Yii::app()->mailer->FromName = Yii::app()->name;
    Yii::app()->mailer->AddAddress($this->email);
    Yii::app()->mailer->Subject = 'Reset Password';
    Yii::app()->mailer->isHTML(true);
    Yii::app()->mailer->getView('receipt', array('booking' => $this,'user' => $user,'title' => "Reset password"),'html');

    if(!Yii::app()->mailer->Send())
    {
      echo "Mailer Error: " . Yii::app()->mailer->ErrorInfo;
    }
    else
    {

      $user->password = md5($new_password);
      $user->save();
    }
  }
}
