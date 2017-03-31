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
 */
class Booking extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'booking';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('yatrik_name, address, city, pincode, mobile_no, email, arrival_date, departure_date, receipt_no, deposit_amount, actual_amount, created_date, created_by, updated_date', 'required'),
			array('created_by, updated_by', 'numerical', 'integerOnly'=>true),
			array('yatrik_name, address, city, mobile_no, email, receipt_no', 'length', 'max'=>255),
			array('pincode', 'length', 'max'=>7),
			array('deposit_amount, actual_amount', 'length', 'max'=>10),
			array('notes', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, yatrik_name, address, city, pincode, mobile_no, email, arrival_date, departure_date, receipt_no, deposit_amount, actual_amount, notes, created_date, created_by, updated_date, updated_by', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('yatrik_name',$this->yatrik_name,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('pincode',$this->pincode,true);
		$criteria->compare('mobile_no',$this->mobile_no,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('arrival_date',$this->arrival_date,true);
		$criteria->compare('departure_date',$this->departure_date,true);
		$criteria->compare('receipt_no',$this->receipt_no,true);
		$criteria->compare('deposit_amount',$this->deposit_amount,true);
		$criteria->compare('actual_amount',$this->actual_amount,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('updated_by',$this->updated_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Booking the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
