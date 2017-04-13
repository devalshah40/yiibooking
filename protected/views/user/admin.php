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
		'onchange' => '$.fn.yiiGridView.update("user-grid",{data:{pageSize:$(this).val()}});',
	)
);

$dataProvider = $model->search();
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});

$('.change-pageSize').click(function(){
	$('#user-grid').yiiGridView('update', {
		data: { pageSize: $(this).val() }
	});
});

$('#form-reset-button').click(function()
{
   var id='user-grid';
   var inputSelector='#'+id+' .filters input, '+'#'+id+' .filters select';
   $(inputSelector).each( function(i,o) {
        $(o).val('');
   });
   var data=$.param($(inputSelector));
   $.fn.yiiGridView.update(id, {data: data});
   return false;
});
");
?>
<!--<h1>Manage Users</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php /*echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); */?>
<div class="search-form" style="display:none">
<?php /*$this->renderPartial('_search',array(
	'model'=>$model,
)); */?>
</div><!-- search-form -->
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Manage Users</h3>
				<span class="col-sm-10 pull-right">
          <a href="<?php echo $this->createUrl("/user/create"); ?>" class="btn btn-info" role="button">Add User</a>
          <a href="#" class="btn btn-info" role="button" id='form-reset-button'>Reset Filters</a>
        </span>
			</div>
			<!-- /.box-header -->
			<div class="box-body" >

				<div class="row">
					<?php $this->widget('zii.widgets.grid.CGridView', array(
						'id'=>'user-grid',
						'htmlOptions' => array('class' => 'col-sm-12'),
						'itemsCssClass' => 'table table-bordered table-striped dataTable',
						'loadingCssClass' => 'overlay-wrapper',
						'beforeAjaxUpdate'=> 'js:function(id,options){
                $("#user-grid").append(\'<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>\');
             }',
						'dataProvider'=>$model->search(),

						'ajaxUpdate' => 'example1_paginate',

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
						'filter'=>$model,
						'columns'=>array(
							'id',
							'username',
							'first_name',
							'last_name',
							'email',
							'location',
							'mobile_no',
							array(
								'name' => 'status',
								'value' => '($data->status == 1) ? "Active" : "Inactive"',
								'filter'=> array(1 => 'Active', 0 => 'Inactive')
							),
							/*'create_at',
							'lastvisit_at',
							'status',
							*/
							array(
								'class'=>'CButtonColumn',
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
