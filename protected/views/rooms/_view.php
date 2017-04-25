<?php
/* @var $this RoomsController */
/* @var $data Rooms */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('room_name')); ?>:</b>
	<?php echo CHtml::encode($data->room_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('room_price')); ?>:</b>
	<?php echo CHtml::encode($data->room_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('room_info')); ?>:</b>
	<?php echo CHtml::encode($data->room_info); ?>
	<br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('room_count')); ?>:</b>
  <?php echo CHtml::encode($data->room_count); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('room_capacity')); ?>:</b>
  <?php echo CHtml::encode($data->room_capacity); ?>
  <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('room_status')); ?>:</b>
	<?php echo CHtml::encode($data->room_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_date')); ?>:</b>
	<?php echo CHtml::encode($data->updated_date); ?>
	<br />

	*/ ?>

</div>