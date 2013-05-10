<?php
/* @var $this PayDetailController */
/* @var $model PayDetail */

$this->breadcrumbs=array(
	'Pay Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PayDetail', 'url'=>array('index')),
	array('label'=>'Manage PayDetail', 'url'=>array('admin')),
);
?>

<h1>Create PayDetail</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>