<!-- DataTables -->
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/datatables/dataTables.bootstrap.css">
<?php

$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$pageSizeDropDown = CHtml::dropDownList(
  'pageSize',
  $pageSize,
  Yii::app()->params['pageSizeOptions'],
  array(
    'class'    => 'change-pagesize',
    'onchange' => '$.fn.yiiGridView.update("booking-grid",{data:{pageSize:$(this).val()}});',
  )
);

$dataProvider = $model->search();
/* @var $this BookingController */
/* @var $model Booking */

$this->breadcrumbs = array(
  'Bookings' => array('index'),
  'Manage',
);

$this->menu = array(
  array('label' => 'List Booking', 'url' => array('index')),
  array('label' => 'Create Booking', 'url' => array('create')),
);

$datePickerJs = <<<EOD
    //Date picker
    $('.datepicker').datepicker({
      autoclose: true
    });
EOD;

Yii::app()->clientScript->registerScript('datePicker', $datePickerJs, CClientScript::POS_READY);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#booking-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");


Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
        //use the same parameters that you had set in your widget else the datepicker will be refreshed by default
    $('#datepicker_for_due_date').datepicker();
}
");
?>

<h1>Manage Bookings</h1>

<p>
  You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
  or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
  <?php $this->renderPartial('_search', array(
    'model' => $model,
  )); ?>
</div><!-- search-form -->

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Manage Bookings</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

            <?php $this->widget('zii.widgets.grid.CGridView', array(
              'id' => 'booking-grid',
              'itemsCssClass' => 'table table-bordered table-striped dataTable',
              'loadingCssClass' => 'overlay-wrapper',
              'beforeAjaxUpdate'=> 'js:function(id,options){
                $("#booking-grid").append(\'<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>\');
                console.log($(this));
              }',

              'afterAjaxUpdate' => 'reinstallDatePicker', // (#1)
              'dataProvider' => $model->search(),
              'filter' => $model,
              'columns' => array(
                'id',
                'yatrik_name',
                'city',
                array(
                  'name' => 'created_date',
                  'value' => 'date("d-m-Y",strtotime($data->created_date))',
                  'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'created_date',
                    'language' => 'en-GB',
                    // 'i18nScriptFile' => 'jquery.ui.datepicker-ja.js', (#2)
                    'htmlOptions' => array(
                      'id' => 'datepicker_for_due_date',
                      'size' => '10',
                    ),
                    'defaultOptions' => array(  // (#3)
                      'showOn' => 'focus',
                      'dateFormat' => 'yy/mm/dd',
                      'showOtherMonths' => true,
                      'selectOtherMonths' => true,
                      'changeMonth' => true,
                      'changeYear' => true,
                      'showButtonPanel' => true,
                    )
                  ),
                    true), // (#4)
                ),
                'arrival_date',
                'departure_date',
                'receipt_no',
                'deposit_amount',
                'actual_amount',
                array(
                  'name' => 'created_date',
                  'value' => 'date("d-m-Y",strtotime($data->created_date))',
                  //'filter'=> array(1 => 'Active', 0 => 'Inactive')
                ),
                array(
                  'name' => 'created_by',
                  'value' => '$data->created->name',
                  'filter'=> CHtml::listData(User::model()->findAll(),'id','name'),
                ),
                array(
                  'class' => 'CButtonColumn',
                ),
              ),
              'pager' => array(
                'class' => 'CLinkPager',
                'hiddenPageCssClass' => 'paginate_button disabled',
//            'firstPageCssClass' => 'next hidden',
//            'lastPageCssClass' => 'last hidden',
                'selectedPageCssClass' => 'active',
                'internalPageCssClass' => 'paginate_button ',
                'maxButtonCount'=> 6,
                'header' => '',
                'prevPageLabel' => 'Previous',
                'nextPageLabel' => 'Next',
                'firstPageLabel'=>'First',
                'lastPageLabel'=>'Last',
                'htmlOptions' => array(
                  'class' => 'pagination'
                )
              ),
              'pagerCssClass' => 'dataTables_paginate paging_simple_numbers',
            )); ?>
      </div>
    </div>
  </div>
  </div>