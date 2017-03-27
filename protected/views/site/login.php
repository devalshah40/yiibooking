<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo Yii::app()->theme->baseUrl; ?>"><?php echo CHtml::encode(Yii::app()->name); ?></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <?php $form = $this->beginWidget('CActiveForm', array(
      'id' => 'login-form',
      'action' => CController::createUrl('site/login'),
      'enableClientValidation' => true,
      'enableAjaxValidation'=>true,
      'clientOptions' => array(
        'validateOnSubmit' => true,
      ),
      //'htmlOptions'=>array('class'=>'form-signin')
    )); ?>


    <?php echo CHtml::errorSummary($model); ?>

    <?php echo $form->errorSummary($model); ?>
    <div class="form-group has-feedback">
      <input type="text" class="form-control" placeholder="Username/Email">
      <?php echo $form->textField($model,'username', array('class'=>'form-control', 'placeholder'=> "Username/Email")); ?>
      <?php echo $form->error($model,'username'); ?>

      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <?php echo $form->passwordField($model,'password', array('class'=>'form-control', 'placeholder'=> Yii::t('app', 'Password'))); ?>
      <?php echo $form->error($model,'password'); ?>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
      <div class="col-xs-8">
        <div class="checkbox icheck">
          <label>
            <input type="checkbox"> Remember Me
          </label>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
      </div>
      <!-- /.col -->
    </div>

    <?php $this->endWidget(); ?>

    <a href="#">I forgot my password</a><br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->