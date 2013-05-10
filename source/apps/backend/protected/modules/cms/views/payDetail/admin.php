<?php
/* @var $this PayDetailController */
/* @var $model PayDetail */

$this->breadcrumbs=array(
	'Pay Details'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List PayDetail', 'url'=>array('index')),
	array('label'=>'Create PayDetail', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pay-detail-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Pay Details</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pay-detail-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'header' => 'Sản phẩm',
			'name' => 'product_id',
			'value' => '$data->product->title',
		),
		array(
			'header' => 'Tên',
			'name' => 'name',
		),
		array(
			'header' => 'Số lượng',
			'name' => 'amount',
		),
		array(
			'header' => 'Thời gian',
			'name' => 'created',
			'value' => 'date("H:i:s d-m-Y", $data->created)',
		),
		/*
		'id',
		'session_id',
		'name',
		'address',
		'tel',
		'email',
		'product_id',
		'amount',
		'total_price',
		'status',
		'created',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
