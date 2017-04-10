<?php
/* @var $this BookingController */
/* @var $model Booking */
/* @var $form CActiveForm */
$datePickerJs = <<<EOD
//Date picker
$('.datepickersearch').datepicker(
{'showOn':'focus',
    'dateFormat':'dd-mm-yy',
    'showOtherMonths':true,'selectOtherMonths':true,'changeMonth':true,
    'changeYear':true,'showButtonPanel':true
});
EOD;

Yii::app()->clientScript->registerScript('datePicker', $datePickerJs);

/* @var $this BookingController */
/* @var $model Booking */
/* @var $form CActiveForm */
?>
<div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
            <!-- form start -->
          <?php $form=$this->beginWidget('CActiveForm', array(
            'action'=>Yii::app()->createUrl($this->route),
            'enableAjaxValidation'=>false,
            'htmlOptions' => array('class' => 'form-horizontal'),
          )); ?>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Arrival From Date</label>
              <div class="col-sm-5">
                <?php echo $form->textField($model,'arrival_from_date',array('size'=>60,'maxlength'=>255, 'class' => 'form-control datepickersearch', 'placeholder' => "From date")); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Arrival To Date</label>
              <div class="col-sm-5">
                <?php echo $form->textField($model,'arrival_to_date',array('size'=>60,'maxlength'=>255, 'class' => 'form-control datepickersearch', 'placeholder' => "To date")); ?>
              </div>
            </div>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Departure From Date</label>
              <div class="col-sm-5">
                <?php echo $form->textField($model,'departure_from_date',array('size'=>60,'maxlength'=>255, 'class' => 'form-control datepickersearch', 'placeholder' => "From date")); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Departure To Date</label>
              <div class="col-sm-5">
                <?php echo $form->textField($model,'departure_to_date',array('size'=>60,'maxlength'=>255, 'class' => 'form-control datepickersearch', 'placeholder' => "To date")); ?>
              </div>
            </div>
          </div>

          <div class="box-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">Created From Date</label>
              <div class="col-sm-5">
                <?php echo $form->textField($model,'created_from_date',array('size'=>60,'maxlength'=>255, 'class' => 'form-control datepickersearch', 'placeholder' => "From date")); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Created To Date</label>
              <div class="col-sm-5">
                <?php echo $form->textField($model,'created_to_date',array('size'=>60,'maxlength'=>255, 'class' => 'form-control datepickersearch', 'placeholder' => "To date")); ?>
              </div>
            </div>
          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button class="btn btn-info" type="submit">Search</button>
              </div>
          <?php $this->endWidget(); ?>

        </div><!-- search-form -->

</div>

<!--

	<div class="row">
		<?php /*echo $form->label($model,'id'); */?>
		<?php /*echo $form->textField($model,'id'); */?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model,'yatrik_name'); */?>
		<?php /*echo $form->textField($model,'yatrik_name',array('size'=>60,'maxlength'=>255)); */?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model,'address'); */?>
		<?php /*echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); */?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model,'city'); */?>
		<?php /*echo $form->textField($model,'city',array('size'=>60,'maxlength'=>255)); */?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model,'pincode'); */?>
		<?php /*echo $form->textField($model,'pincode',array('size'=>7,'maxlength'=>7)); */?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model,'mobile_no'); */?>
		<?php /*echo $form->textField($model,'mobile_no',array('size'=>60,'maxlength'=>255)); */?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model,'email'); */?>
		<?php /*echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); */?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model,'arrival_date'); */?>
		<?php /*echo $form->textField($model,'arrival_date',array('id' => 'booking_arrival_date', 'class' => 'form-control', 'placeholder' => "Arrival date")); */?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model,'departure_date'); */?>
		<?php /*echo $form->textField($model,'departure_date',array('id' => 'booking_departure_date', 'class' => 'form-control', 'placeholder' => "Departure date")); */?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model,'receipt_no'); */?>
		<?php /*echo $form->textField($model,'receipt_no',array('size'=>60,'maxlength'=>255)); */?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model,'deposit_amount'); */?>
		<?php /*echo $form->textField($model,'deposit_amount',array('size'=>10,'maxlength'=>10)); */?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model,'actual_amount'); */?>
		<?php /*echo $form->textField($model,'actual_amount',array('size'=>10,'maxlength'=>10)); */?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model,'notes'); */?>
		<?php /*echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); */?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model,'created_date'); */?>
		<?php /*echo $form->textField($model,'created_date',array('id' => 'booking_created_date', 'class' => 'form-control', 'placeholder' => "Created date")); */?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model,'created_by'); */?>
		<?php /*echo $form->textField($model,'created_by'); */?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model,'updated_date'); */?>
		<?php /*echo $form->textField($model,'updated_date'); */?>
	</div>

	<div class="row">
		<?php /*echo $form->label($model,'updated_by'); */?>
		<?php /*echo $form->textField($model,'updated_by'); */?>
	</div>
-->
