<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/resources/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/resources/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/resources/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/resources/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/resources/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php 
		$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Danh Mục', 'url'=>array('/cms/categories/admin'), 'active'=> (Yii::app()->controller->id=='categories') ? true : false),
				array('label'=>'Giới Thiệu', 'url'=>Yii::app()->createUrl('/cms/introduction/admin'), 'active'=> (Yii::app()->controller->id=='introduction') ? true : false),
				array('label'=>'Sản Phẩm', 'url'=>array('/cms/products/admin'), 'active'=> (Yii::app()->controller->id=='products') ? true : false),
				array('label'=>'Dịch Vụ', 'url'=>Yii::app()->createUrl('/cms/services/admin'), 'active'=> (Yii::app()->controller->id=='services') ? true : false),
				array('label'=>'Tin Tức', 'url'=>Yii::app()->createUrl('/cms/news/admin'), 'active'=> (Yii::app()->controller->id=='news') ? true : false),
				array('label'=>'Hình Ảnh - Quảng Cáo', 'url'=>array('/cms/advertising/admin'), 'active'=> (Yii::app()->controller->id=='advertising') ? true : false),
				array('label'=>'Login', 'url'=>array('/user/auth'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
