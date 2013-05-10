<?php
/* @var $this ContentController */
/* @var $model Content */

$this->breadcrumbs=array(
	'Contents'=>array('index'),
	'Manage',
);
$rcontent = Yii::app()->request->getQuery('Content');
$this->menu=array(
	array('label'=>'List Content', 'url'=>array('index')),
	array('label'=>'Create Content', 'url'=>array('create/'.CHtml::activeId($model, 'sectionid').'/'.$rcontent['sectionid'])),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('content-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Contents</h1>

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
	'id'=>'content-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		'slug',
//		'introtext',
//		'fulltext',
		'home',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
