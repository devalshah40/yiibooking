<?php
/* @var $this BookingController */
/* @var $model Booking */

$this->breadcrumbs = array(
  'Bookings' => array('index'),
  $model->id,
);
//
//$this->menu=array(
//	array('label'=>'List Booking', 'url'=>array('index')),
//	array('label'=>'Create Booking', 'url'=>array('create')),
//	array('label'=>'Update Booking', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete Booking', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage Booking', 'url'=>array('admin')),
//);
?>

<h3>Booking Details #<?php echo $model->id; ?></h3>


<div class="row">
  <!-- right column -->
  <div class="col-md-12">
    <!-- Horizontal Form -->

    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Receipt #<?php echo $model->id; ?></h3>
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
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('yatrik_name')); ?></th>
            <td>
              <?php echo CHtml::encode($model->yatrik_name); ?>
            </td>
          </tr>

          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('address')); ?></th>
            <td>
              <?php echo CHtml::encode($model->address); ?>
            </td>
          </tr>

          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('city')); ?></th>
            <td>
              <?php echo CHtml::encode($model->city); ?>
            </td>
          </tr>

          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('pincode')); ?></th>
            <td>
              <?php echo CHtml::encode($model->pincode); ?>
            </td>
          </tr>

          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('mobile_no')); ?></th>
            <td>
              <?php echo CHtml::encode($model->mobile_no); ?>
            </td>
          </tr>

          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('email')); ?></th>
            <td>
              <?php echo CHtml::encode($model->email); ?>
            </td>
          </tr>


          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('arrival_date')); ?></th>
            <td>
              <?php echo CHtml::encode($model->arrival_date); ?>
            </td>
          </tr>

          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('departure_date')); ?></th>
            <td>
              <?php echo CHtml::encode($model->departure_date); ?>
            </td>
          </tr>
          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('receipt_no')); ?></th>
            <td>
              <?php echo CHtml::encode($model->receipt_no); ?>
            </td>
          </tr>
          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('deposit_amount')); ?></th>
            <td>
              <?php echo CHtml::encode($model->deposit_amount); ?>
            </td>
          </tr>
          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('actual_amount')); ?></th>
            <td>
              <?php echo CHtml::encode($model->actual_amount); ?>
            </td>
          </tr>
          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('notes')); ?></th>
            <td>
              <?php echo CHtml::encode($model->notes); ?>
            </td>
          </tr>
          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('created_date')); ?></th>
            <td>
              <?php echo CHtml::encode($model->created_date); ?>
            </td>
          </tr>
          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('created_by')); ?></th>
            <td>
              <?php echo CHtml::encode($model->created->name); ?>
            </td>
          </tr>
          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('updated_date')); ?></th>
            <td>
              <?php echo CHtml::encode($model->updated_date); ?>
            </td>
          </tr>
          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('updated_by')); ?></th>
            <td>
              <?php echo CHtml::encode($model->updated->name); ?>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
  <!-- /.box-body -->
</div>
