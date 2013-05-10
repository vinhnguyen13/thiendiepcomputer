<?php
/* @var $this PayDetailController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pay Details',
);

$this->menu=array(
	array('label'=>'Create PayDetail', 'url'=>array('create')),
	array('label'=>'Manage PayDetail', 'url'=>array('admin')),
);
?>

<h1>Pay Details</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
