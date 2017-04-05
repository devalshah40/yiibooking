<?php
/* @var $this BookingController */
/* @var $model Booking */
/* @var $form CActiveForm */
$datePickerJs = <<<EOD
//Date picker
$('.datepicker').datepicker({
    format: "dd-mm-yyyy",
    daysOfWeekHighlighted: "0",
    autoclose: true,
    todayHighlight: true,
    toggleActive: true
});
EOD;

Yii::app()->clientScript->registerScript('datePicker', $datePickerJs, CClientScript::POS_READY);

$daterange = "$('#daterange').daterangepicker({ 
  startDate: '".date('d-m-Y',strtotime($model->arrival_date))."',
  endDate: '".date('d-m-Y',strtotime($model->departure_date))."',
  minDate: '".date('d-m-Y',strtotime($model->arrival_date))."',
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
   divtest.setAttribute("class", "removeclass"+room);
	 var rdiv = "removeclass"+room;
   divtest.innerHTML = '<div class="form-group removeclass">          <div class="col-xs-4">                    <input type="text" onkeyup="this.value=this.value.replace(/[^0-9]/g,\'\');" class="form-control searchrooms" placeholder="No of rooms" name="Booking[noOfRooms][' + room + ']">              </div>              <div class="col-xs-7"> <select class="form-control" id="search_rooms'+room+'" name="Booking[rooms][' + room + ']"></select>            </div>              <div class="col-xs-1">                <button type="button" class="btn btn-danger btn-flat" onclick="remove_education_fields('+ room +');">-</button>              </div></div>';   
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
  <!-- right column -->
  <div class="col-md-12">
    <!-- Horizontal Form -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Fields with * are required.</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'booking-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
        'htmlOptions' => array('class' => 'form-horizontal'),
      )); ?>

      <?php echo $form->errorSummary($model, null, '', array('class' => 'alert alert-error')); ?>
      <input type="hidden" id="rooms_count" value="<?php echo count(Rooms::getRooms()); ?>">
      <div class="box-body">
        <div class="form-group">
          <?php echo $form->labelEx($model,'yatrik_name', array('class' => 'col-sm-2 control-label')); ?>

          <div class="col-sm-5">
            <?php echo $form->textField($model,'yatrik_name',array('size'=>60,'maxlength'=>255, 'class' => 'form-control', 'placeholder' => "Yatrik Name")); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model,'address', array('class' => 'col-sm-2 control-label')); ?>

          <div class="col-sm-5">
            <?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50,'maxlength'=>255, 'class' => 'form-control', 'placeholder' => "Address")); ?>
          </div>
        </div>
        <div class="form-group">
          <?php echo $form->labelEx($model,'city', array('class' => 'col-sm-2 control-label')); ?>

          <div class="col-sm-5">
            <?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>255, 'class' => 'form-control', 'placeholder' => "City")); ?>
          </div>
        </div>


        <div class="form-group">
          <?php echo $form->labelEx($model,'pincode', array('class' => 'col-sm-2 control-label')); ?>

          <div class="col-sm-5">
            <?php echo $form->textField($model,'pincode',array('size'=>7,'maxlength'=>7, 'class' => 'form-control', 'placeholder' => "pincode")); ?>
          </div>
        </div>

        <div class="form-group">
          <?php echo $form->labelEx($model,'mobile_no', array('class' => 'col-sm-2 control-label')); ?>

          <div class="col-sm-5">
            <?php echo $form->textField($model,'mobile_no',array('size'=>60,'maxlength'=>255, 'class' => 'form-control', 'placeholder' => "Mobile no")); ?>
          </div>
        </div>

        <div class="form-group">
          <?php echo $form->labelEx($model,'email', array('class' => 'col-sm-2 control-label')); ?>

          <div class="col-sm-5">
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255, 'class' => 'form-control', 'placeholder' => "Email Address")); ?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Date range:</label>
          <div class="col-sm-5">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
                <?php echo $form->textField($model, 'dateRange', array('class' => 'form-control pull-right', 'id' => "daterange")); ?>
              </div>
          </div>
        </div>


        <div class="form-group">
          <?php echo $form->labelEx($model,'receipt_no', array('class' => 'col-sm-2 control-label')); ?>

          <div class="col-sm-5">
            <?php echo $form->textField($model,'receipt_no',array('size'=>60,'maxlength'=>255, 'class' => 'form-control', 'placeholder' => "Receipt no")); ?>
          </div>
        </div>

        <div class="form-group">
          <?php echo $form->labelEx($model,'deposit_amount', array('class' => 'col-sm-2 control-label')); ?>

          <div class="col-sm-5">
            <?php echo $form->textField($model,'deposit_amount',array('size'=>10,'maxlength'=>10, 'class' => 'form-control', 'placeholder' => "Deposit amount")); ?>
          </div>
        </div>

        <div class="form-group">
          <?php echo $form->labelEx($model,'actual_amount', array('class' => 'col-sm-2 control-label')); ?>

          <div class="col-sm-5">
            <?php echo $form->textField($model,'actual_amount',array('size'=>10,'maxlength'=>10, 'class' => 'form-control', 'placeholder' => "Actual amount")); ?>
          </div>
        </div>

        <div class="form-group">
          <?php echo $form->labelEx($model,'notes', array('class' => 'col-sm-2 control-label')); ?>

          <div class="col-sm-5">
            <?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50, 'class' => 'form-control', 'placeholder' => "Notes")); ?>
          </div>
        </div>


        <!-- /.form group -->
        <div class="form-group">
          <label class="col-sm-2 control-label">Booked Rooms:</label>

          <div class="col-sm-5">
            <?php
            if (!empty($model->rooms)) {
              foreach ($model->rooms as $key => $room) {
                if ($key == 0) {
                  ?>
                  <div class="form-group">
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
                  </div>
                <?php } else { ?>
                  <div class="removeclass<?php echo $key; ?>">
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
                    </div>
                  </div>
                  <?php
                }
                ?>
                <?php
              }
            }
            ?>
            <div id="education_fields"></div>
          </div>
          </div>
          <!-- /.input group -->
        </div>

        <?php
        echo $form->hiddenField($model,'dateRange', array('value' => $model->dateRange));
        echo $form->hiddenField($model,'arrival_date', array('value' => $model->startDate));
        echo $form->hiddenField($model,'departure_date', array('value' => $model->endDate));
//        if (!empty($model->rooms)) {
//          foreach ($model->rooms as $key => $room) {
//            echo $form->hiddenField($model, 'noOfRooms[' . $key . ']', array('value' => $model->noOfRooms[$key]));
//            echo $form->hiddenField($model, 'rooms[' . $key . ']', array('value' => $model->rooms[$key]));
//          }
//        }
        ?>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="col-sm-offset-2 col-sm-5">
          <button type="submit" class="btn btn-info "><?php echo($model->isNewRecord ? 'Create' : 'Save') ?></button>
          <button type="submit" class="btn btn-default">Cancel</button>
        </div>
      </div>
      <!-- /.box-footer -->
      <?php $this->endWidget(); ?>
    </div>
  </div><!-- form -->