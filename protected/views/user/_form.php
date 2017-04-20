<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="row">
	<!-- right column -->
	<div class="col-md-12">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">
					<?php echo ($model->isNewRecord ? 'Create' : 'Update') ?> User
				</h3>
			</div>
			<!-- /.box-header -->
			<!-- form start -->

			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'user-form',
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
					<?php echo $form->labelEx($model, 'username', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-5">
						<?php echo $form->textField($model, 'username', array('size' => 20, 'maxlength' => 20, 'class' => 'form-control', 'placeholder' => "Username")); ?>
					</div>
				</div>

				<div class="form-group">
					<?php echo $form->labelEx($model, 'first_name', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-5">
						<?php echo $form->textField($model, 'first_name', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control', 'placeholder' => "First Name")); ?>
					</div>
				</div>

				<div class="form-group">
					<?php echo $form->labelEx($model, 'last_name', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-5">
						<?php echo $form->textField($model, 'last_name', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control', 'placeholder' => "Last Name")); ?>
					</div>
				</div>

				<div class="form-group">
					<?php echo $form->labelEx($model, 'email', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-5">
						<?php echo $form->emailField($model, 'email', array('size' => 60, 'maxlength' => 128, 'class' => 'form-control', 'placeholder' => "Email")); ?>
					</div>
				</div>

				<div class="form-group">
					<?php echo $form->labelEx($model, 'location', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-5">
						<?php echo $form->textField($model, 'location', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control', 'placeholder' => "Location")); ?>
					</div>
				</div>


				<div class="form-group">
					<?php echo $form->labelEx($model, 'mobile_no', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-5">
						<?php echo $form->telField($model, 'mobile_no', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control', 'placeholder' => "Mobile no")); ?>
					</div>
				</div>


				<div class="form-group">
					<?php echo $form->labelEx($model, 'status', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-5">
						<?php echo $form->dropDownList($model, 'status', array(1 => 'Active', 0 => 'Inactive'), array('class' => 'form-control', 'placeholder' => "Status", 'prompt'=>'Select Status')); ?>
					</div>
				</div>


				<div class="form-group">
					<?php echo $form->labelEx($model, 'password', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-5">
						<?php echo $form->passwordField($model, 'password', array('size' => 60, 'maxlength' => 128, 'class' => 'form-control', 'placeholder' => "Password",'value' => '')); ?>
					</div>
				</div>

				<div class="form-group">
					<?php echo $form->labelEx($model, 'password_repeat', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-5">
						<?php echo $form->passwordField($model, 'password_repeat', array('size' => 60, 'maxlength' => 128, 'class' => 'form-control', 'placeholder' => "Confirm Password",'value' => '')); ?>
					</div>
				</div>


			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<div class="col-sm-offset-2 col-sm-5">
					<button type="submit" class="btn btn-info "><?php echo($model->isNewRecord ? 'Create' : 'Save') ?></button>
					<a href="<?php echo $this->createUrl("/user/admin"); ?>" class="btn btn-default" role="button">Cancel</a>
				</div>
			</div>
			<!-- /.box-footer -->
			<?php $this->endWidget(); ?>
		</div>
	</div><!-- form -->