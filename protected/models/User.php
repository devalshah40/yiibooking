<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $password_repeat
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $location
 * @property string $mobile_no
 * @property string $create_at
 * @property string $lastvisit_at
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Booking[] $bookingsCreated
 * @property Booking[] $bookingsUpdated
 */
class User extends CActiveRecord
{
  public $password_repeat;
  public $initialPassword;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
      array('username, email, first_name, last_name, location, mobile_no', 'required'),
      array('password, password_repeat', 'required', 'on' => 'create'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>20),
			array('password, email', 'length', 'max'=>128),
      array('password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match"),
      array('first_name, last_name, location, mobile_no', 'length', 'max'=>255),
			array('lastvisit_at, create_at', 'safe'),
      array('password_repeat', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, email, location, mobile_no, create_at, lastvisit_at, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
      'booking_created' => array(self::HAS_MANY, 'Booking', 'created_by'),
      'booking_updated' => array(self::HAS_MANY, 'Booking', 'updated_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'User ID',
			'username' => 'Username',
			'password' => 'Password',
      'password_repeat' => 'Confirm Password',
      'first_name' => 'First Name',
      'last_name' => 'Last Name',
			'email' => 'Email',
			'location' => 'Location',
			'mobile_no' => 'Mobile No',
			'create_at' => 'Created At',
			'lastvisit_at' => 'Lastvisit At',
			'status' => 'Status',
		);
	}

  public function getName() {
    return ucfirst(strtolower($this->first_name)). " ". ucfirst(strtolower($this->last_name));
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
    $criteria->compare('username',$this->username,true);
    $criteria->compare('first_name',$this->first_name,true);
    $criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('mobile_no',$this->mobile_no,true);
		$criteria->compare('create_at',$this->create_at,true);
		$criteria->compare('lastvisit_at',$this->lastvisit_at,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

  public function beforeSave()
  {
    $this->initialPassword = $this->password;
    $this->password = md5($this->initialPassword);

    if ($this->isNewRecord) {
      $this->create_at = date('Y-m-d H:i:s');
    } else {

    }
//    // in this case, we will use the old hashed password.
    if (!empty($this->password) && !empty($this->password_repeat)) {
      $this->sendMail();
    }
//      $this->password = $this->repeat_password=$this->initialPassword;

    return parent::beforeSave();
  }


  public function sendMail(){
    //        Yii::app()->mailer->Host       = "smtp.gmail.com"; // SMTP server
    //        Yii::app()->mailer->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
    // 1 = errors and messages
    // 2 = messages only
    Yii::app()->mailer->IsSMTP(); // telling the class to use SMTP
    Yii::app()->mailer->SMTPAuth   = true;                  // enable SMTP authentication
    Yii::app()->mailer->SMTPSecure = "ssl";                 // sets the prefix to the servier
    Yii::app()->mailer->Host       = Yii::app()->params['mailer_host'];      // sets GMAIL as the SMTP server
    Yii::app()->mailer->Port       = Yii::app()->params['mailer_port'];                   // set the SMTP port for the GMAIL server
    Yii::app()->mailer->Username   = Yii::app()->params['mailer_username'];  // GMAIL username
    Yii::app()->mailer->Password   = Yii::app()->params['mailer_password'];            // GMAIL password

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

    $users = User::model()->findAllByAttributes(array('status' => 1));

    foreach ($users as $userInfo) {
      Yii::app()->mailer->AddBCC($userInfo->email, $userInfo->name);
    }

    if ($this->isNewRecord) {
      $message = "Your new account created at ". Yii::app()->name .".";
      $message .= "<br>Below are login credentials";

    } else {
      $message = "Your details are updated at ". Yii::app()->name .".";
      $message .= "<br>Below are login credentials";
    }

    Yii::app()->mailer->From = Yii::app()->params['replyToEmail'];
    Yii::app()->mailer->FromName = Yii::app()->name;
    Yii::app()->mailer->AddAddress($this->email, $this->name);

    if ($this->isNewRecord) {
      Yii::app()->mailer->Subject = "New account is created at ". Yii::app()->name .".";
    } else {
      Yii::app()->mailer->Subject = "Account details are updated at ". Yii::app()->name .".";
    }

    Yii::app()->mailer->isHTML(true);
    Yii::app()->mailer->getView('account', array('user' => $this, 'message' => $message),'html');


    if(!Yii::app()->mailer->Send())
    {
      echo "Mailer Error: " . Yii::app()->mailer->ErrorInfo;
    }
    else
    {

    }
  }
}
