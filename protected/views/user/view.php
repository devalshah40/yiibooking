<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>
<div class="row">
	<!-- right column -->
	<div class="col-md-12">
		<!-- Horizontal Form -->
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">User Details</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body no-padding">
				<table class="table table-striped">
					<tbody>
					<tr>
						<th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('id')); ?></th>
						<td><?php echo CHtml::encode($model->id); ?></td>
					</tr>
					<tr>
						<th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('username')); ?></th>
						<td><?php echo CHtml::encode($model->username); ?></td>
					</tr>
					<tr>
						<th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('first_name')); ?></th>
						<td><?php echo CHtml::encode($model->first_name); ?></td>
					</tr>
					<tr>
						<th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('last_name')); ?></th>
						<td><?php echo CHtml::encode($model->last_name); ?></td>
					</tr>
					<tr>
						<th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('email')); ?></th>
						<td><?php echo CHtml::encode($model->email); ?></td>
					</tr>
					<tr>
						<th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('location')); ?></th>
						<td><?php echo CHtml::encode($model->location); ?></td>
					</tr>

					</tbody>
				</table>
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<div class="col-sm-offset-2 col-sm-5">
					<a href="<?php echo $this->createUrl("/user/admin"); ?>" class="btn btn-info" role="button">Back</a>
				</div>
			</div>
		</div>
	</div>
	<!-- /.box-body -->
</div>