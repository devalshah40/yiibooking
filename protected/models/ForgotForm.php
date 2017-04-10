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
      array('email', 'exist', 'className'=>'User','attributeName'=>'email','message' => 'Such email {value} is not registered in the system'),
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
//        Yii::app()->mailer->Password   = "Kangana!@#";            // GMAIL password

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

        Yii::app()->mailer->From = Yii::app()->params['replyToEmail'];
        Yii::app()->mailer->FromName = Yii::app()->name;
        Yii::app()->mailer->AddAddress($this->email);
        Yii::app()->mailer->Subject = 'Reset Password';
        Yii::app()->mailer->isHTML(true);
        Yii::app()->mailer->getView('forgot', array('password'=>$new_password),'html');

        if(!Yii::app()->mailer->Send())
        {
          echo "Mailer Error: " . Yii::app()->mailer->ErrorInfo;
        }
        else
        {
          $user = User::model()->findByAttributes(array('email' => $this->email));
          $user->password = md5($new_password);
          $user->save();
        }


        return true;
	}


}
