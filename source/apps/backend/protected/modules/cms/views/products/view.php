<?php
/* @var $this ProductsController */
/* @var $model Products */

$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'Manage Products', 'url'=>array('admin')),
);
?>

<h1>View Products #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'slug',
		'introtext',
		'fulltext',
		'home',
		'sectionid',
		'catid',
		'created',
		'created_by',
		'modified',
		'modified_by',
		'published',
		'public_time',
		'images',
		'urls',
		'ordering',
		'metakey',
		'metadesc',
		'metadata',
		'hits',
//		'params',
		'access',
		'price',
		'amount',
		'discount',
		'price_new',
	),
)); ?>
