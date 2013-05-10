<div class="nav">
	<?php 
	$controller = Yii::app()->controller->id;
	$action = Yii::app()->controller->action->id;
	$items = array(
		array(
			'label'=>'Trang chủ', 
			'url'=>array('/site/index'),
			'linkOptions'=>array('class'=>(in_array($controller, array('site')) && in_array($action, array('index'))) ? 'current' : ''),
		),
		array(
			'label'=>'Giới thiệu', 
			'url'=>array('/content/introduction'), 
			'linkOptions'=>array('class'=>(in_array($controller, array('content')) && in_array($action, array('introduction'))) ? 'current' : ''),
		),
		array(
			'label'=>'Sản Phẩm', 
			'url'=>array('/products'), 
			'linkOptions'=>array('class'=>(in_array($controller, array('products'))) ? 'current' : ''),
		),
		array(
			'label'=>'Dịch Vụ', 
			'url'=>Yii::app()->createUrl('/services'), 
			'linkOptions'=>array('class'=>(in_array($controller, array('services'))) ? 'current' : ''),
		),
		array(
			'label'=>'Tin Tức', 
			'url'=>Yii::app()->createUrl('/news'), 
			'linkOptions'=>array('class'=>(in_array($controller, array('news'))) ? 'current' : ''),
		),
		array(
			'label'=>'Liên Hệ', 
			'url'=>Yii::app()->createUrl('/site/contact'), 
			'linkOptions'=>array('class'=>(in_array($controller, array('site')) && in_array($action, array('contact'))) ? 'current' : ''),
		),
	);
	$this->widget('zii.widgets.CMenu',array(
		'items'=>$items,
	)); 
	?>
</div>