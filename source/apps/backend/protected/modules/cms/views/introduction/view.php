<?php
/* @var $this IntroductionController */
/* @var $model Content */

$this->breadcrumbs=array(
	'Contents'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Content', 'url'=>array('index')),
	array('label'=>'Create Content', 'url'=>array('create')),
	array('label'=>'Update Content', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Content', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Content', 'url'=>array('admin')),
);
?>

<h1>View Content #<?php echo $model->id; ?></h1>

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
		'params',
		'access',
	),
)); ?>
