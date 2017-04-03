<?php
/* @var $this BookingController */
/* @var $model Booking */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'booking-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'yatrik_name'); ?>
		<?php echo $form->textField($model,'yatrik_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'yatrik_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pincode'); ?>
		<?php echo $form->textField($model,'pincode',array('size'=>7,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'pincode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mobile_no'); ?>
		<?php echo $form->textField($model,'mobile_no',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'mobile_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
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

	<div class="row">
		<?php echo $form->labelEx($model,'receipt_no'); ?>
		<?php echo $form->textField($model,'receipt_no',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'receipt_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deposit_amount'); ?>
		<?php echo $form->textField($model,'deposit_amount',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'deposit_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'actual_amount'); ?>
		<?php echo $form->textField($model,'actual_amount',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'actual_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
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

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->