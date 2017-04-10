<?php
/* @var $this RoomsController */
/* @var $model Rooms */
/* @var $form CActiveForm */
?>

<div class="row">
  <!-- right column -->
  <div class="col-md-12">
    <!-- Horizontal Form -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">
          <?php //echo($model->isNewRecord ? 'Add' : 'Update') ?>
          Create Room
        </h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'rooms-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('class' => 'form-horizontal'),
      )); ?>
      <?php echo $form->errorSummary($model, null, '', array('class' => 'alert alert-error')); ?>
      <div class="box-body">
        <div class="form-group">
          <?php echo $form->labelEx($model, 'room_name', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-5">
            <?php echo $form->textField($model, 'room_name', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control', 'placeholder' => "Name")); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model, 'room_price', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-5">
            <?php echo $form->textField($model, 'room_price', array('size' => 10, 'maxlength' => 10, 'class' => 'form-control', 'placeholder' => "Room Price")); ?>
          </div>
        </div>

        <div class="form-group">
          <?php echo $form->labelEx($model, 'room_info', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-5">
            <?php echo $form->textArea($model, 'room_info', array('rows' => 6, 'cols' => 50, 'class' => 'form-control', 'placeholder' => "Room Information")); ?>
          </div>
        </div>

        <div class="form-group">
          <?php echo $form->labelEx($model, 'room_capacity', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-5">
            <?php echo $form->textField($model, 'room_capacity', array('class' => 'form-control', 'placeholder' => "Room Capacity")); ?>
          </div>
        </div>

        <div class="form-group">
          <?php echo $form->labelEx($model, 'room_status', array('class' => 'col-sm-2 control-label')); ?>
          <div class="col-sm-5">
            <?php echo $form->dropDownList($model, 'room_status', array(1 => 'Active', 0 => 'Inactive'), array('class' => 'form-control', 'placeholder' => "Room Status")); ?>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="col-sm-offset-2 col-sm-5">
          <button type="submit" class="btn btn-info "><?php echo($model->isNewRecord ? 'Create' : 'Save') ?></button>
          <a href="<?php echo $this->createUrl("/rooms/index"); ?>" class="btn btn-default" role="button">Cancel</a>
        </div>
      </div>
      <!-- /.box-footer -->
      <?php $this->endWidget(); ?>
    </div>
  </div><!-- form -->