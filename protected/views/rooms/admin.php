<?php
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
");
?>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Manage Rooms</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
          <div class="row">
        <?php $this->widget('zii.widgets.grid.CGridView', array(
          'id' => 'rooms-grid',
          'htmlOptions' => array('class' => 'col-sm-12'),
          'itemsCssClass' => 'table table-bordered table-striped dataTable',
          'dataProvider' => $model->search(),
          'enableSorting' => false,
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
        </div>
      </div>
    </div>
  </div>
</div>