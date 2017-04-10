<?php
/* @var $this BookingController */
/* @var $model Booking */

$this->breadcrumbs = array(
  'Bookings' => array('index'),
  $model->id,
);
//var_dump($model);
//exit;
//
//$this->menu=array(
//	array('label'=>'List Booking', 'url'=>array('index')),
//	array('label'=>'Create Booking', 'url'=>array('create')),
//	array('label'=>'Update Booking', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete Booking', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage Booking', 'url'=>array('admin')),
//);
?>

<!--<h3>Booking Details #<?php /*echo $model->id; */?></h3>-->


<div class="row">
  <!-- right column -->
  <div class="col-md-12">
    <!-- Horizontal Form -->

    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Booking Details #<?php echo $model->id; ?></h3>
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
              <?php echo CHtml::encode(date('jS \of F, Y',strtotime($model->arrival_date))); ?>
            </td>
          </tr>

          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('departure_date')); ?></th>
            <td>
              <?php echo CHtml::encode(date('jS \of F, Y',strtotime($model->departure_date))); ?>
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
          <?php foreach($model->booking_details as $key => $booking_details) {
//            var_dump($booking_details);exit;
            ?>
          <tr>
            <th style="width: 150px"><?php echo 'Rooms '.($key+1); ?></th>
            <td>
              <table class="table table-striped">
                <tbody>
                <tr>
                  <th style="width: 120px"><?php echo $booking_details->room->room_name; ?> Price</th>
                  <td>₹<?php echo $booking_details->room_price; ?></td>
                </tr>
                <tr>
                  <th style="width: 120px">No of days</th>
                  <td><?php echo $model->noOfDays; ?></td>
                </tr>
                <tr>
                  <th style="width: 120px">No of rooms</th>
                  <td><?php echo $booking_details->number_count; ?></td>
                </tr>
                <tr>
                  <th style="width: 120px">Final price</th>
                  <td>(₹<?php echo $booking_details->room_price; ?> * <?php echo $model->noOfDays; ?> * <?php echo $booking_details->number_count; ?>) = ₹<?php echo ($booking_details->room_price * $model->noOfDays * $booking_details->number_count); ?></td>
                </tr>
                </tbody>
              </table>
            </td>
          </tr>
          <?php } ?>
          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('created_date')); ?></th>
            <td>
              <?php echo CHtml::encode(date('jS \of F, Y h:i:s A',strtotime($model->created_date))); ?>
            </td>
          </tr>
          <tr>
            <th style="width: 150px"><?php echo CHtml::encode($model->getAttributeLabel('created_by')); ?></th>
            <td>
              <?php echo CHtml::encode($model->created->name); ?>
            </td>
          </tr>
          <tr>
            <th style="width: 150px">Last updated</th>
            <td>
              <?php echo CHtml::encode(date('jS \of F, Y h:i:s A',strtotime($model->updated_date))); ?>
            </td>
          </tr>
          <tr>
            <th style="width: 150px">Last updated</th>
            <td>
              <?php echo CHtml::encode($model->updated->name); ?>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="col-sm-offset-2 col-sm-5">
          <a href="<?php echo $this->createUrl("/booking/admin"); ?>" class="btn btn-info" role="button">Back</a>
        </div>
      </div>

    </div>
  </div>
  <!-- /.box-body -->
</div>
