<?php
/* @var $this PayDetailController */
/* @var $model PayDetail */

$this->breadcrumbs=array(
	'Pay Details'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PayDetail', 'url'=>array('index')),
	array('label'=>'Create PayDetail', 'url'=>array('create')),
	array('label'=>'View PayDetail', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PayDetail', 'url'=>array('admin')),
);
?>

<h1>Update PayDetail <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>