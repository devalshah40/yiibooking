<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl .'/plugins/datatables/jquery.dataTables.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl .'/plugins/datatables/dataTables.bootstrap.min.js', CClientScript::POS_END);

/* @var $this BookingController */
/* @var $model Booking */
/* @var $form CActiveForm */
$datePickerJs = <<<EOT
$('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
EOT;

Yii::app()->clientScript->registerScript('datePicker', $datePickerJs);
?>
<!-- DataTables -->
<?php
$datePickerJs1 = <<<EOD
//Date picker
$('.datepickersearch').datepicker(
{'showOn':'focus',
     'format': "dd-mm-yyyy",
    'showOtherMonths':true,'selectOtherMonths':true,'changeMonth':true,
    'changeYear':true,'showButtonPanel':true
});
EOD;

Yii::app()->clientScript->registerScript('datePickerSearch', $datePickerJs1, CClientScript::POS_READY);
?>

<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/datatables/dataTables.bootstrap.css">


<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Search Available Rooms with Dates</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- Horizontal Form -->
						<!-- form start -->
						<?php $form=$this->beginWidget('CActiveForm', array(
							'action'=>Yii::app()->createUrl($this->route),
							'enableAjaxValidation'=>false,
							'htmlOptions' => array('class' => 'form-horizontal','id' => 'search_form'),
						)); ?>
						<div class="box-body">
							<div class="form-group">
								<label class="col-sm-2 control-label">From Date</label>
								<div class="col-sm-5">
									<?php echo $form->textField($model,'startDate',array('size'=>60,'maxlength'=>255, 'class' => 'form-control datepickersearch', 'placeholder' => "From date")); ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">To Date</label>
								<div class="col-sm-5">
									<?php echo $form->textField($model,'endDate',array('size'=>60,'maxlength'=>255, 'class' => 'form-control datepickersearch', 'placeholder' => "To date")); ?>
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
				<div class="row">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
						<tr>
							<th>Rendering engine</th>
							<th>Browser</th>
							<th>Platform(s)</th>
							<th>Engine version</th>
							<th>CSS grade</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>Trident</td>
							<td>Internet
								Explorer 4.0
							</td>
							<td>Win 95+</td>
							<td> 4</td>
							<td>X</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col -->
</div>