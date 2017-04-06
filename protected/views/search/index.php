<?php
$daterange = "$('#daterange').daterangepicker({ 
  startDate: '".date('d-m-Y')."',
  endDate: '".date('d-m-Y',strtotime('+2 days'))."',
  minDate: '".date('d-m-Y')."',
  locale: {
        format: 'DD-MM-YYYY'
  }
});";

Yii::app()->clientScript->registerScript('daterange', $daterange, CClientScript::POS_READY);

$roomJs = <<<EOD
var room = 20;
var rooms_available = $("#rooms_count").val();
function education_fields() {
    var rooms_count = $("input:text.form-control.searchrooms").length;
    if(rooms_count == rooms_available ) {
      alert("Only "+rooms_available+" roomtypes are available.");
      return false;
    }
   room++;
   var objTo = document.getElementById("education_fields");
   var divtest = document.createElement("div");
   divtest.setAttribute("class", "form-group removeclass"+room);
	 var rdiv = "removeclass"+room;
   divtest.innerHTML = '<div class="form-group removeclass">          <div class="col-xs-4">                    <input type="text" onkeyup="this.value=this.value.replace(/[^0-9]/g,\'\');" class="form-control searchrooms" placeholder="No of rooms" name="SearchForm[noOfRooms][' + room + ']">              </div>              <div class="col-xs-7"> <select class="form-control" id="search_rooms'+room+'" name="SearchForm[rooms][' + room + ']"></select>            </div>              <div class="col-xs-1">                <button type="button" class="btn btn-danger btn-flat" onclick="remove_education_fields('+ room +');">-</button>              </div>  <br>  <br>        </div>';   
   var options = $("#search_rooms > option").clone();   
   divobj = $(divtest);
   console.log(divobj.find("#search_rooms"+room));
   divobj.find("#search_rooms"+room).append(options);
   
   console.log(divobj.find("#search_rooms"+room));
   objTo.appendChild(divobj[0]);
}
function remove_education_fields(rid) {
	   $(".removeclass"+rid).remove();
	   room--;
   }
EOD;


Yii::app()->clientScript->registerScript('room', $roomJs, CClientScript::POS_END);

?>
<div class="row">
  <div class="col-md-5">

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Search Rooms</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <!-- form start -->
      <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'rooms-form',
        'action' => $this->createUrl('/search/index'),
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'htmlOptions' => array('role' => 'form'),
      )); ?>
      <?php echo $form->errorSummary($model, null, '', array('class' => 'alert alert-error')); ?>
      <input type="hidden" id="rooms_count" value="<?php echo count(Rooms::getRooms()); ?>" >
      <div class="box-body">
        <!-- Date range -->
        <div class="form-group">
          <label>Date range:</label>

          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <?php echo $form->textField($model, 'dateRange', array('class' => 'form-control pull-right', 'id' => "daterange")); ?>
          </div>
          <!-- /.input group -->
        </div>
        <!-- /.form group -->
        <div class="form-group">
          <label>Select Rooms:</label>

          <div class="input-group">
            <?php
            if (!empty($model->rooms)) {
              $i = 0;
              foreach ($model->rooms as $key => $room) {
                if ($i == 0) {
                  ?>
                  <div class="col-xs-4">
                    <?php echo $form->textField($model, 'noOfRooms[' . $key . ']', array('class' => 'form-control searchrooms', 'placeholder' => "No of rooms")); ?>
                  </div>
                  <div class="col-xs-7">
                    <?php echo $form->dropDownList($model, "rooms[" . $key . "]", Rooms::getRooms(), array(
                      'class' => "form-control",
                      'id' => "search_rooms"
                    )); ?>
                  </div>
                  <div class="col-xs-1">
                    <button type="button" class="btn btn-info btn-flat" onclick="education_fields();">+</button>
                  </div>
                  <br>
                  <br>
                  <br>
                <?php } else { ?>
                  <div class="form-group removeclass<?php echo $key; ?>">
                    <div class="form-group removeclass">
                      <div class="col-xs-4">
                        <?php echo $form->textField($model, 'noOfRooms[' . $key . ']', array('class' => 'form-control searchrooms', 'placeholder' => "No of rooms")); ?>
                      </div>
                      <div class="col-xs-7">
                        <?php echo $form->dropDownList($model, "rooms[" . $key . "]", Rooms::getRooms(), array(
                          'class' => "form-control",
                        )); ?>
                      </div>
                      <div class="col-xs-1">
                        <button onclick="remove_education_fields(<?php echo $key; ?>);" class="btn btn-danger btn-flat"
                                type="button">
                          -
                        </button>
                      </div>
                      <br> <br>
                    </div>
                  </div>
                  <?php
                }
                ?>
                <?php
                $i++;
              }
            } else {
              ?>
              <div class="col-xs-4">
                <?php echo $form->textField($model, 'noOfRooms[0]', array('class' => 'form-control searchrooms', 'placeholder' => "No of rooms")); ?>
              </div>
              <div class="col-xs-7">
                <?php echo $form->dropDownList($model, "rooms[0]", Rooms::getRooms(), array(
                  'class' => "form-control",
                  'id' => "search_rooms"
                )); ?>
              </div>
              <div class="col-xs-1">
                <button type="button" class="btn btn-info btn-flat" onclick="education_fields();">+</button>
              </div>
              <br>
              <br>
              <br>

              <?php
            }
            ?>
            <div id="education_fields"></div>
          </div>
          <!-- /.input group -->
        </div>
      </div>
      <!-- /.box-body -->

      <div class="box-footer">
        <button class="btn btn-primary" type="submit">Search</button>
      </div>
    </div>
  </div>
  <!-- /.col -->
  <div class="col-md-7">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <?php if(empty($model->book_button)) { ?>
          <li class="active"><a data-toggle="tab" href="#activity" aria-expanded="true">Search result</a></li>
          <li class=""><a href="#booking_form" class="disabled" aria-expanded="false" >Booking form</a></li>
        <?php }else { ?>
          <li class=""><a data-toggle="tab" href="#activity" aria-expanded="false">Search result</a></li>
          <li class="active"><a href="#booking_form" data-toggle="tab" aria-expanded="true" >Booking form</a></li>
        <?php } ?>

      </ul>
      <div class="tab-content">
        <div id="activity" class="tab-pane <?php echo empty($model->book_button) ? 'active' : ''; ?>">
          <?php
          if (!empty($model->bookedRooms)) {
            foreach ($model->bookedRooms as $bookedRoom) {
              $is_sucess = ($bookedRoom['price'] > 0) ? 'box-success' : 'box-danger';
              ?>
              <div class="box box-solid <?php echo $is_sucess; ?>">
                <div class="box-header">
                  <h3
                    class="box-title"><?php echo $bookedRoom['searched_rooms']; ?> <?php echo $bookedRoom['room_name']; ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <?php if (empty($bookedRoom['price'])) {
                    if ($bookedRoom['available_rooms'] > 0) {
                      ?>
                      Only <?php echo $bookedRoom['available_rooms']; ?> rooms available to book.
                    <?php } else { ?>
                      No rooms are available on these days.
                    <?php }
                  } else { ?>
                    <table class="table table-striped">
                      <tbody>
                      <tr>
                        <th style="width: 120px">AC Room Price</th>
                        <td>₹<?php echo $bookedRoom['room_price']; ?></td>
                      </tr>
                      <tr>
                        <th style="width: 120px">No of days</th>
                        <td><?php echo $bookedRoom['noOfDays']; ?></td>
                      </tr>
                      <tr>
                        <th style="width: 120px">No of rooms</th>
                        <td><?php echo $bookedRoom['searched_rooms']; ?></td>
                      </tr>
                      <tr>
                        <th style="width: 120px">Final price</th>
                        <td>(₹<?php echo $bookedRoom['room_price']; ?> * <?php echo $bookedRoom['noOfDays']; ?> * <?php echo $bookedRoom['searched_rooms']; ?>) = ₹<?php echo ($bookedRoom['room_price'] * $bookedRoom['noOfDays'] * $bookedRoom['searched_rooms']); ?></td>
                      </tr>
                      </tbody>
                    </table>
                  <?php } ?>
                </div><!-- /.box-body -->
              </div>
              <?php
            }
          ?>
          <div class="box-body">
            <div class="col-sm-9">
              <span
                class="description"><strong>Total price :- </strong> ₹<?php echo $model->total_booking_price; ?></span>
            </div>
            <div class="col-sm-3">
              <button class="btn btn-block btn-primary <?php echo (!$model->is_bookable) ? "disabled" : ''; ?>"
                      type="<?php echo (!$model->is_bookable) ? "button" : 'submit'; ?>" name="SearchForm[book_button]" value="book">Book
              </button>
            </div>
          </div>
         <?php  } else { ?>
              Please search rooms.
          <?php } ?>
          <?php $this->endWidget(); ?>
        </div>
        <!-- /.tab-pane -->
        <div id="booking_form" class="tab-pane <?php echo !empty($model->book_button) ? 'active' : ''; ?>">
          <!-- form start -->
          <?php $bookingForm = $this->beginWidget('CActiveForm', array(
            'id' => 'booking-form',
            'action' => $this->createUrl('/search/booking'),
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'htmlOptions' => array('role' => 'form','class' => 'form-horizontal'),
          )); ?>

          <?php echo $form->errorSummary($bookingModel, null, '', array('class' => 'alert alert-error')); ?>
          <div class="form-group">
            <div class="form-group">
              <label class="col-sm-2 control-label">Yatrik Name</label>
              <div class="col-sm-10">
                <?php echo $bookingForm->textField($bookingModel,'yatrik_name', array('class' => 'form-control', 'placeholder' => "Yatrik Name")); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Address</label>

              <div class="col-sm-10">
                <?php echo $bookingForm->textArea($bookingModel,'address', array('class' => 'form-control', 'placeholder' => "Address")); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">City</label>

              <div class="col-sm-10">
                <?php echo $bookingForm->textField($bookingModel,'city', array('class' => 'form-control', 'placeholder' => "Ahmedabad")); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Pincode</label>

              <div class="col-sm-10">
                <?php echo $bookingForm->textField($bookingModel,'pincode', array('class' => 'form-control', 'placeholder' => "380005")); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Mobile no</label>

              <div class="col-sm-10">
                <?php echo $bookingForm->textField($bookingModel,'mobile_no', array('class' => 'form-control', 'placeholder' => "94268XXXXX")); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Email</label>

              <div class="col-sm-10">
                <?php echo $bookingForm->textField($bookingModel,'email', array('class' => 'form-control', 'placeholder' => "Email-ID")); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Receipt No</label>
              <div class="col-sm-10">
                <?php echo $bookingForm->textField($bookingModel,'receipt_no', array('class' => 'form-control', 'placeholder' => "Receipt no")); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Deposit amount</label>
              <div class="col-sm-10">
                <?php echo $bookingForm->textField($bookingModel,'deposit_amount', array('class' => 'form-control', 'placeholder' => "Deposit amount")); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Actual Amount</label>
              <div class="col-sm-10">
                <?php echo $bookingForm->textField($bookingModel,'actual_amount', array('class' => 'form-control', 'readOnly' => "readOnly", 'value' => $model->total_booking_price)); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Notes</label>
              <div class="col-sm-10">
                <?php echo $bookingForm->textArea($bookingModel,'notes', array('class' => 'form-control', 'placeholder' => "Notes")); ?>
              </div>
            </div>
            <?php
              echo $bookingForm->hiddenField($bookingModel,'dateRange', array('value' => $model->dateRange));
              echo $bookingForm->hiddenField($bookingModel,'arrival_date', array('value' => $model->startDate));
              echo $bookingForm->hiddenField($bookingModel,'departure_date', array('value' => $model->endDate));
              if (!empty($model->rooms)) {
                foreach ($model->rooms as $key => $room) {
                  echo $bookingForm->hiddenField($bookingModel, 'noOfRooms[' . $key . ']', array('value' => $model->noOfRooms[$key]));
                  echo $bookingForm->hiddenField($bookingModel, 'rooms[' . $key . ']', array('value' => $model->rooms[$key]));
                }
              }
            ?>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button class="btn btn-block btn-primary" type="submit" name="Booking[book_button]" value="book">Book
                </button>
              </div>
            </div>

            <?php $this->endWidget(); ?>
          </div>
        </div>
        <!-- /.tab-pane -->
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>

  <!-- /.col -->
</div>