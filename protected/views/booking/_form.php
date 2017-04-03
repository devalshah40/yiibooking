<?php
/* @var $this BookingController */
/* @var $model Booking */
/* @var $form CActiveForm */
?>

<div class="row">
  <!-- right column -->
  <div class="col-md-12">
    <!-- Horizontal Form -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Fields with * are required.</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'booking-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('class' => 'form-horizontal'),
      )); ?>

      <?php echo $form->errorSummary($model, null, '', array('class' => 'alert alert-error')); ?>
      <div class="box-body">
        <div class="form-group">
          <?php echo $form->labelEx($model,'yatrik_name', array('class' => 'col-sm-2 control-label')); ?>); ?>

          <div class="col-sm-5">
            <?php echo $form->textField($model,'yatrik_name',array('size'=>60,'maxlength'=>255, 'class' => 'form-control', 'placeholder' => "Yatrik Name")); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model,'address', array('class' => 'col-sm-2 control-label')); ?>); ?>

          <div class="col-sm-5">
            <?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50,'maxlength'=>255, 'class' => 'form-control', 'placeholder' => "Address")); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model,'city', array('class' => 'col-sm-2 control-label')); ?>); ?>

          <div class="col-sm-5">
            <?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>255, 'class' => 'form-control', 'placeholder' => "City")); ?>
          </div>
        </div>


        <div class="form-group">
          <?php echo $form->labelEx($model,'pincode', array('class' => 'col-sm-2 control-label')); ?>); ?>

          <div class="col-sm-5">
            <?php echo $form->textField($model,'pincode',array('size'=>7,'maxlength'=>7, 'class' => 'form-control', 'placeholder' => "pincode")); ?>
          </div>
        </div>

        <div class="form-group">
          <?php echo $form->labelEx($model,'mobile_no', array('class' => 'col-sm-2 control-label')); ?>); ?>

          <div class="col-sm-5">
            <?php echo $form->textField($model,'mobile_no',array('size'=>60,'maxlength'=>255, 'class' => 'form-control', 'placeholder' => "Mobile no")); ?>
          </div>
        </div>

        <div class="form-group">
          <?php echo $form->labelEx($model,'email', array('class' => 'col-sm-2 control-label')); ?>); ?>

          <div class="col-sm-5">
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255, 'class' => 'form-control', 'placeholder' => "Email Address")); ?>
          </div>
        </div>

        <div class="row">
          <?php echo $form->labelEx($model,'arrival_date'); ?>
          <?php echo $form->textField($model,'arrival_date'); ?>
          <?php echo $form->error($model,'arrival_date'); ?>
        </div>

        <div class="row">
          <?php echo $form->labelEx($model,'departure_date'); ?>
          <?php echo $form->textField($model,'departure_date'); ?>
          <?php echo $form->error($model,'departure_date'); ?>
        </div>

        <div class="form-group">
          <?php echo $form->labelEx($model,'receipt_no', array('class' => 'col-sm-2 control-label')); ?>); ?>

          <div class="col-sm-5">
            <?php echo $form->textField($model,'receipt_no',array('size'=>60,'maxlength'=>255, 'class' => 'form-control', 'placeholder' => "Receipt no")); ?>
          </div>
        </div>

        <div class="form-group">
          <?php echo $form->labelEx($model,'deposit_amount', array('class' => 'col-sm-2 control-label')); ?>); ?>

          <div class="col-sm-5">
            <?php echo $form->textField($model,'deposit_amount',array('size'=>10,'maxlength'=>10, 'class' => 'form-control', 'placeholder' => "Deposit amount")); ?>
          </div>
        </div>

        <div class="form-group">
          <?php echo $form->labelEx($model,'actual_amount', array('class' => 'col-sm-2 control-label')); ?>); ?>

          <div class="col-sm-5">
            <?php echo $form->textField($model,'actual_amount',array('size'=>10,'maxlength'=>10, 'class' => 'form-control', 'placeholder' => "Actual amount")); ?>
          </div>
        </div>

        <div class="form-group">
          <?php echo $form->labelEx($model,'notes', array('class' => 'col-sm-2 control-label')); ?>); ?>

          <div class="col-sm-5">
            <?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50, 'class' => 'form-control', 'placeholder' => "Notes")); ?>
          </div>
        </div>

        <div class="row">
          <?php echo $form->labelEx($model,'created_date'); ?>
          <?php echo $form->textField($model,'created_date'); ?>
          <?php echo $form->error($model,'created_date'); ?>
        </div>

        <div class="row">
          <?php echo $form->labelEx($model,'created_by'); ?>
          <?php echo $form->textField($model,'created_by'); ?>
          <?php echo $form->error($model,'created_by'); ?>
        </div>

        <div class="row">
          <?php echo $form->labelEx($model,'updated_date'); ?>
          <?php echo $form->textField($model,'updated_date'); ?>
          <?php echo $form->error($model,'updated_date'); ?>
        </div>

        <div class="row">
          <?php echo $form->labelEx($model,'updated_by'); ?>
          <?php echo $form->textField($model,'updated_by'); ?>
          <?php echo $form->error($model,'updated_by'); ?>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="col-sm-offset-2 col-sm-5">
          <button type="submit" class="btn btn-info "><?php echo($model->isNewRecord ? 'Create' : 'Save') ?></button>
          <button type="submit" class="btn btn-default">Cancel</button>
        </div>
      </div>
      <!-- /.box-footer -->
      <?php $this->endWidget(); ?>
    </div>
  </div><!-- form -->