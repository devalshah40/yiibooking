<?php
/* @var $this SiteController */
/* @var $model ForgotForm */
/* @var $form CActiveForm  */

$this->pageTitle = 'Forgot Password';

Yii::app()->clientScript
  ->registerCoreScript('jquery')
  ->registerScript("forgot","
        $('.drilldown_close').on('click',function(){
            $('#modal').hide().find('#message').text('');
            preLoader('hide');
        });

        function preLoader(v){
        var bg = $('.background_loader');
        if(v == 'show'){
            bg.addClass('show');
        }else{
            bg.removeClass('show');
        }
    }
    ");

?>
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo Yii::app()->theme->baseUrl; ?>"><?php echo CHtml::encode(Yii::app()->name); ?></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Forgot Password</p>

    <?php $form = $this->beginWidget('CActiveForm', array(
      'id' => 'forgot-form',
      'action' => CController::createUrl('site/forgot')
      //'htmlOptions'=>array('class'=>'form-signin')
    )); ?>

    <?php echo $form->errorSummary($model, null, '', array('class' => 'alert alert-error')); ?>
    <div class="form-group has-feedback">
      <?php echo $form->textField($model,'email', array('class'=>'form-control', 'placeholder'=> "Email", 'type'=> "email")); ?>

    </div>
    <div class="form-group has-feedback">
        <?php $this->widget('ext.yii-recaptcha.ReCaptcha', array(
          'model' => $model,
          'attribute' => 'verifyCode',
        ));?>
    </div>
    <div class="row">
      <div class="col-xs-4">
        <a href="<?= Yii::app()->createUrl('site/login'); ?>" class="auth_link">Cancel</a>
      </div>
      <!-- /.col -->
      <div class="col-xs-4">
        <?= CHtml::htmlButton('Submit',array('type'=>'submit','class'=>'btn btn-primary btn-block btn-flat','ajax'=>array(
          'type'=>'POST',
          'url'=>Yii::app()->createUrl('site/forgot'),
          'beforeSend' => 'function(){
                preLoader("show");
            }',
          'success'=>'function(data) {
                $("#modal").show().find("#message").text(data);
            }',)
        )); ?>
      </div>
      <!-- /.col -->
    </div>

    <?php $this->endWidget(); ?>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->