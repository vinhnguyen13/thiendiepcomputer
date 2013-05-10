<?php
/* @var $this PayDetailController */
/* @var $model PayDetail */

$this->breadcrumbs=array(
	'Pay Details'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List PayDetail', 'url'=>array('index')),
	array('label'=>'Create PayDetail', 'url'=>array('create')),
	array('label'=>'Update PayDetail', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PayDetail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PayDetail', 'url'=>array('admin')),
);
?>

<h1>View PayDetail #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'session_id',
		'name',
		'address',
		'tel',
		'email',
		array(               // related city displayed as a link
			'label'=>'Sản phẩm',
			'type'=>'raw',
			'value'=>$model->product->title,
		),
		'amount',
		'total_price',
		'status',
		'created',
	),
)); ?>
