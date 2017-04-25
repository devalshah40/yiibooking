<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');\
//Yii::setPathOfAlias('booster', dirname(__FILE__) . DIRECTORY_SEPARATOR . '../extensions/yiibooster');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
  'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
  'name' => 'Girnar Dharamshala',
  'theme' => 'adminlte', // requires you to copy the theme under your themes directory
  'defaultController' => 'site/index',
  // preloading 'log' component
  /*'preload' => array('log'
    //, 'booster'
  ),*/
  // autoloading model and component classes
  'import' => array(
    'application.models.*',
    'application.components.*',
//    'application.modules.user.models.*',
//    'application.modules.user.components.*',
//    'application.modules.rights.*',
//    'application.modules.rights.components.*'
  ),

  'modules' => array(
    /*'user' => array(
      # encrypting method (php hash function)
      'hash' => 'md5',

      # send activation email
      'sendActivationMail' => true,

      # allow access for non-activated users
      'loginNotActiv' => false,

      # activate user on registration (only sendActivationMail = false)
      'activeAfterRegister' => false,

      # automatically login from registration
      'autoLogin' => true,

      # registration path
      'registrationUrl' => array('/user/registration'),

      # recovery password path
      'recoveryUrl' => array('/user/recovery'),

      # login form path
      'loginUrl' => array('/user/login'),

      # page after login
      'returnUrl' => array('/user/profile'),

      # page after logout
      'returnLogoutUrl' => array('/user/login'),
    ),*/
    /*'rights' => array(


      'superuserName'=>'Admin', // Name of the role with super user privileges.
      'authenticatedName'=>'Authenticated',  // Name of the authenticated user role.
      'userIdColumn'=>'id', // Name of the user id column in the database.
      'userNameColumn'=>'username',  // Name of the user name column in the database.
      'enableBizRule'=>true,  // Whether to enable authorization item business rules.
      'enableBizRuleData'=>true,   // Whether to enable data for business rules.
      'displayDescription'=>true,  // Whether to use item description instead of name.
      'flashSuccessKey'=>'RightsSuccess', // Key to use for setting success flash messages.
      'flashErrorKey'=>'RightsError', // Key to use for setting error flash messages.

      'baseUrl'=>'/rights', // Base URL for Rights. Change if module is nested.
      'layout'=>'rights.views.layouts.main',  // Layout to use for displaying Rights.
      'appLayout'=>'application.views.layouts.main', // Application layout.
      'cssFile'=>'rights.css', // Style sheet file to use for Rights.
      'install'=>false,  // Whether to enable installer.
      'debug'=>false,
    ),*/
    // uncomment the following to enable the Gii tool

    /*'gii' => array(
      'class' => 'system.gii.GiiModule',
      'generatorPaths' => array(
        'booster.gii',
      ),
      'password' => '123',
      // If removed, Gii defaults to localhost only. Edit carefully to taste.
//			'ipFilters'=>array('127.0.0.1','::1'),
    ),*/

  ),

  // application components
  'components' => array(
    /*'booster' => array(
      'class' => 'booster.components.Booster',
    ),*/
    'request' => array(
      'enableCsrfValidation' => true,
      'enableCookieValidation' => true,
    ),
    'user' => array(
      'class' => 'CWebUser',
      // enable cookie-based authentication
      'allowAutoLogin' => true,
      'loginUrl' => array('/site/login'),
      'returnUrl' => array('/site/index'),
    ),

    // uncomment the following to enable URLs in path-format
    /*
    'urlManager'=>array(
      'urlFormat'=>'path',
      'rules'=>array(
        '<controller:\w+>/<id:\d+>'=>'<controller>/view',
        '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
        '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
      ),
    ),
    */
    // database settings are configured in database.php
    'db' => require(dirname(__FILE__) . '/database.php'),
//    'authManager' => array(
//      'class' => 'CPhpAuthManager',
//      'connectionID'=>'db',
//      'itemTable'=>'authitem',
//      'itemChildTable'=>'authitemchild',
//      'assignmentTable'=>'authassignment',
//      'rightsTable'=>'rights',
//    ),
    'errorHandler' => array(
      // use 'site/error' action to display errors
      'errorAction' => YII_DEBUG ? null : 'site/error',
    ),

    'clientScript' => array(
      'coreScriptPosition' => CClientScript::POS_END,
      'defaultScriptPosition' => CClientScript::POS_END,
      'defaultScriptFilePosition' => CClientScript::POS_END,
//      'packages' => require(dirname(__FILE__) . '/../views/assets/packages.php'),
    ),

    'reCaptcha' => array(
      'name' => 'reCaptcha',
      'class' => 'ext.yii-recaptcha.ReCaptcha',
      'key' => '6Lcblx4UAAAAAECC35gJZUVNUzGjRjzn9GBg5w24',
      'secret' => '6Lcblx4UAAAAAJO0mmm5vP0PS5JaSJTpWo0eX6wB',
    ),

    'mailer' => array(
      'class' => 'ext.mailer.EMailer',
      'pathViews' => 'application.views.email',
      'pathLayouts' => 'application.views.email.layouts'
    ),

  ),

  // application-level parameters that can be accessed
  // using Yii::app()->params['paramName']
  'params' => array(
    // this is used in contact page
    'mailer_host' => "sg2plcpnl0223.prod.sin2.secureserver.net",
    'mailer_port' => 465,
    'mailer_username' => 'info@neminathheights.com',
    'mailer_password' => '{^V=.;Q(AWV%',

    'adminEmail' => 'keyur.gandhi12@gmail.com',
    'replyToEmail' => 'info@neminathheights.com',
    'defaultPageSize' => 5,
    'pageSizeOptions' => array(5 => 5, 10 => 10, 20 => 20, 50 => 50, 100 => 100),
    'footer_name' => 'Shree Siddhi Kailash Yatrik Bhavan',
    'footer_address' => array(
      'Rupaytan road,Opp. Minraj school,',
      'Bhavnath taleti,Junagadh'
    )
  )
);
