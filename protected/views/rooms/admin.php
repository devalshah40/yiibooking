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
    'onchange' => '$.fn.yiiGridView.update("rooms-grid",{data:{pageSize:$(this).val()}});',
  )
);

$dataProvider = $model->search();
/* @var $this RoomsController */
/* @var $model Rooms */

$this->breadcrumbs = array(
  'Rooms' => array('index'),
  'Manage',
);

$this->menu = array(
  array('label' => 'List Rooms', 'url' => array('index')),
  array('label' => 'Create Rooms', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#rooms-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});

$('.change-pageSize').click(function(){
	$('#rooms-grid').yiiGridView('update', {
		data: { pageSize: $(this).val() }
	});
});
");
?>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Manage Rooms</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body" >

        <div class="row">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
              'id' => 'rooms-grid',
              'htmlOptions' => array('class' => 'col-sm-12'),
              'itemsCssClass' => 'table table-bordered table-striped dataTable',
              'loadingCssClass' => 'overlay-wrapper',
              'beforeAjaxUpdate'=> 'js:function(id,options){
                $("#rooms-grid").append(\'<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>\');
              }',

              'dataProvider' => $dataProvider,

              'ajaxUpdate' => 'example1_paginate',
              'enableSorting' => false,
              'enablePagination' => false,
//              'summaryText'=>'Displaying {start}-{end} of {count} result(s)',
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
//              'pagerCssClass' => 'dataTables_paginate paging_simple_numbers',
              'filter' => $model,
              'columns' => array(
                'room_name',
                'room_price',
                'room_info',
                'room_capacity',
                array(
                  'name' => 'room_status',
                  'value' => '($data->room_status == 1) ? "Active" : "Inactive"',
                  'filter'=> array(1 => 'Active', 0 => 'Inactive')
                ),
                /*
                'created_date',
                'updated_date',
                */
                array(
                  'class' => 'CButtonColumn',
                ),
              ),
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
</div>