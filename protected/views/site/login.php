<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo Yii::app()->theme->baseUrl; ?>"><?php echo CHtml::encode(Yii::app()->name); ?></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <?php $form = $this->beginWidget('CActiveForm', array(
      'id' => 'login-form',
      'action' => CController::createUrl('site/login')
      //'htmlOptions'=>array('class'=>'form-signin')
    )); ?>

    <?php echo $form->errorSummary($model, null, '', array('class' => 'alert alert-error')); ?>
    <div class="form-group has-feedback">
      <?php echo $form->textField($model,'username', array('class'=>'form-control', 'placeholder'=> "Username/Email")); ?>

      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
      <?php echo $form->passwordField($model,'password', array('class'=>'form-control', 'placeholder'=> Yii::t('app', 'Password'))); ?>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
      <div class="col-xs-8">
        <div class="checkbox icheck">
          <label>

            <?php echo $form->checkBox($model,'rememberMe'); ?>

            Remember Me
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

    <a href="<?php echo CController::createUrl('site/forgot'); ?>">I forgot my password</a><br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->