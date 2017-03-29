<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ForgotForm extends CFormModel
{
	public $email;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(

			array('email, verifyCode', 'required'),
			array('email', 'email'),
            array('email', 'exist', 'className'=>'CcUser','attributeName'=>'email','message' => 'Such email {value} is not registered in the system'),
            array('verifyCode', 'ext.yii-recaptcha.ReCaptchaValidator'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
            'email' => 'Email address',
            'verifyCode' => 'ReCAPTCHA'
		);
	}

    /**
     * @return bool
     * @throws CException
     */
	public function reset()
	{
        $new_password = Yii::app()->getSecurityManager()->generateRandomString(8,true);

        $user = CcUser::model()->findByAttributes(array('email' => $this->email));
        $user->password = CPasswordHelper::hashPassword($new_password);
        $user->save();

        Yii::app()->mailer->From = Yii::app()->params['replyToEmail'];
        Yii::app()->mailer->FromName = Yii::app()->name;
        Yii::app()->mailer->AddAddress($this->email);
        Yii::app()->mailer->Subject = 'Reset Password';
        Yii::app()->mailer->isHTML(true);
        Yii::app()->mailer->getView('forgot', array('password'=>$new_password),'html');
        Yii::app()->mailer->Send();

        return true;
	}


}
