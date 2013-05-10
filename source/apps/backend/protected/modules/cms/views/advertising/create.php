<?php
/* @var $this AdvertisingController */
/* @var $model Advertising */

$this->breadcrumbs=array(
	'Advertisings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Advertising', 'url'=>array('admin')),
);
?>

<h1>Create Advertising</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>