<?php
/* @var $this RoomsController */
/* @var $model Rooms */

$this->breadcrumbs=array(
	'Rooms'=>array('index'),
	$model->room_name,
);

$this->menu=array(
	array('label'=>'List Rooms', 'url'=>array('index')),
	array('label'=>'Create Rooms', 'url'=>array('create')),
	array('label'=>'Update Rooms', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Rooms', 'url'=>'#', 'linkOptions'=> array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Rooms', 'url'=>array('admin')),
);

?>
<div class="row">
  <!-- right column -->
  <div class="col-md-12">
    <!-- Horizontal Form -->
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Room Details</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <table class="table table-striped">
          <tbody>
          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('room_name')); ?></th>
            <td><?php echo CHtml::encode($model->room_name); ?></td>
          </tr>

          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('room_price')); ?></th>
            <td>
              <?php echo CHtml::encode($model->room_price); ?>
            </td>
          </tr>

          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('room_info')); ?></th>
            <td>
              <?php echo CHtml::encode($model->room_info); ?>
            </td>
          </tr>

          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('room_capacity')); ?></th>
            <td>
              <?php echo CHtml::encode($model->room_capacity); ?>
            </td>
          </tr>

          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('room_status')); ?></th>
            <td>
              <?php echo CHtml::encode(($model->room_status == 1) ? "Active" : "Inactive"); ?>
            </td>
          </tr>

          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('created_date')); ?></th>
            <td>
              <?php echo CHtml::encode(date('jS \of F, Y',strtotime($model->created_date))); ?>
            </td>
          </tr>

          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('updated_date')); ?></th>
            <td>
              <?php echo CHtml::encode(date('jS \of F, Y',strtotime($model->updated_date))); ?>
            </td>
          </tr>

          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="col-sm-offset-2 col-sm-5">
          <a href="<?php echo $this->createUrl("/rooms/index"); ?>" class="btn btn-info" role="button">Back</a>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>