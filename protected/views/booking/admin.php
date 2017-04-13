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



Yii::app()->clientScript->registerScript('search', "
$('#form-search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#booking-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	$('.search-form').toggle();
	return false;
});

$('#form-reset-button').click(function()
{
   var id='booking-grid';
   var inputSelector='#'+id+' .filters input, '+'#'+id+' .filters select';
   $(inputSelector).each( function(i,o) {
        $(o).val('');
   });
   var data=$.param($(inputSelector));
   $.fn.yiiGridView.update(id, {data: data});
   return false;
});

$('#export-button').on('click',function() {
    $.fn.yiiGridView.export();
});
$.fn.yiiGridView.export = function() {
    $.fn.yiiGridView.update('booking-grid',{ 
        success: function() {
            $('#booking-grid').removeClass('grid-view-loading');
            window.location = '". $this->createUrl('exportFile')  . "';
        },
        data: $('.search-form form').serialize() + '&export=true'
    });
}

");
?>

<?php

$reinstalldatepicker = <<<EOD
function reinstallDatePicker(id, data) {
$('.datepicker').datepicker(
    {'showOn':'focus',
    'dateFormat':'dd-mm-yy',
    'showOtherMonths':true,'selectOtherMonths':true,'changeMonth':true,
    'changeYear':true,'showButtonPanel':true
});
}
EOD;

Yii::app()->clientScript->registerScript('reinstallDatePicker', $reinstalldatepicker);
?>
<!--<h1>Manage Bookings</h1>

<p>
  You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
  or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
-->
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Manage Bookings</h3>
        <span class="col-sm-10 pull-right">          
          <a href="#" class="btn btn-info" role="button" id='export-button'>Export CSV</a>   
          <a href="#" class="btn btn-info" role="button" id='form-reset-button'>Reset Filters</a>
          <a href="#" class="btn btn-info" role="button" id='form-search-button'>Advanced Search</a>
        </span> 
      </div>
      <!-- /.box-header -->
      <div class="box-body">

        <div class="search-form" style="display:none">
          <?php $this->renderPartial('_search', array(
            'model' => $model,
          )); ?>
        </div><!-- search-form -->

        <div class="row">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
              'id' => 'booking-grid',
              'itemsCssClass' => 'table table-bordered table-striped dataTable',
              'loadingCssClass' => 'overlay-wrapper',
              'beforeAjaxUpdate'=> 'js:function(id,options){
                $("#booking-grid").append(\'<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>\');
              }',
              'htmlOptions' => array('class' => 'grid-view col-sm-12'),
              'enablePagination' => false,

              'ajaxUpdate' => 'example1_paginate',
              'afterAjaxUpdate' => 'reinstallDatePicker', // (#1)
              'dataProvider' => $dataProvider,
              'filter' => $model,
              'columns' => array(
                'id',
                'yatrik_name',
                'city',
                array(
                  'name' => 'arrival_date',
                  'value' => 'date("d-m-Y",strtotime($data->arrival_date))',
                  'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'arrival_date',
                    'htmlOptions' => array(
                      'class' => 'datepicker',
                      'size' => '10',
                    ),
                    'options' => array(
                      'showOn' => 'focus',
                      'dateFormat' => 'dd-mm-yy',
                      'showOtherMonths' => true,
                      'selectOtherMonths' => true,
                      'changeMonth' => true,
                      'changeYear' => true,
                      'showButtonPanel' => true,
                    )
                  ),
                   true), // (#4)
                ),
                array(
                  'name' => 'departure_date',
                  'value' => 'date("d-m-Y",strtotime($data->departure_date))',
                  'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'departure_date',
                    'htmlOptions' => array(
                      'class' => 'datepicker',
                      'size' => '10',
                    ),
                    'options' => array(
                      'showOn' => 'focus',
                      'dateFormat' => 'dd-mm-yy',
                      'showOtherMonths' => true,
                      'selectOtherMonths' => true,
                      'changeMonth' => true,
                      'changeYear' => true,
                      'showButtonPanel' => true,
                    )
                  ),
                   true), // (#4)
                ),
                'receipt_no',
                'deposit_amount',
                'actual_amount',
                 array(
                  'name' => 'created_date',
                  'value' => 'date("d-m-Y",strtotime($data->created_date))',
                  'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'created_date',
                    'htmlOptions' => array(
                      'class' => 'datepicker',
                      'size' => '10',
                    ),
                    'options' => array(
                      'showOn' => 'focus',
                      'dateFormat' => 'dd-mm-yy',
                      'showOtherMonths' => true,
                      'selectOtherMonths' => true,
                      'changeMonth' => true,
                      'changeYear' => true,
                      'showButtonPanel' => true,
                    )
                  ),
                   true), // (#4)
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
              /*'pager' => array(
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
              'pagerCssClass' => 'dataTables_paginate paging_simple_numbers',*/
            )); ?>
      </div>
      
      <div class="row">
            <div class="col-sm-5">
              <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                <label>
                 Show <?php echo $pageSizeDropDown; ?> entries</label>
              </div>
            </div>
            <div class="col-sm-7">
              <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
              <?php $this->widget('CLinkPager', array(
                'pages' => $dataProvider->pagination,


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
              )); ?>
              </div>
            </div>
          </div>
      </div>

        </div>
    </div>
  </div>