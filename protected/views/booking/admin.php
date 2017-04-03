<?php
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

        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
          <div class="row">
            <?php $this->widget('zii.widgets.grid.CGridView', array(
              'id' => 'booking-grid',
              'itemsCssClass' => 'table table-bordered table-striped dataTable',
              'dataProvider' => $model->search(),
              'filter' => $model,
              'columns' => array(
                'id',
                'yatrik_name',
                'address',
                'city',
                'pincode',
                'mobile_no',
                'email',
                'arrival_date',
                'departure_date',
                'receipt_no',
                'deposit_amount',
                'actual_amount',
                'notes',
                'created_date',
                'created_by',
                'updated_date',
                'updated_by',
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
  </div>
</div>
