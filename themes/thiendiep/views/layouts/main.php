<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<meta name="Description" content="">
<meta name="Keywords" content="">
<meta name="robots" content="index, follow" />
<meta name="viewport" content="width=1024, initial-scale=1" />
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/resource/css/style.less?r=<?php echo time()?>" rel="stylesheet/less" type="text/css">
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/js/less.js"></script>	
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/js/jquery.js"></script>	
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/js/jquery.mSimpleSlidebox.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/js/slide.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/js/common.js"></script>
</head>
<body>
	<div class="wrapper">
		<div class="header">
			<a href="<?php echo Yii::app()->homeUrl;?>" class="logo" title="PFT Logo">
				<img src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/css/images/logo.jpg" alt="<?php echo Yii::app()->name;?>" border="0" />
			</a>
			<div class="company">
				<h1><?php echo Yii::app()->name;?></h1>
				<p class="slogan">Total Solutions for all your finishing needs</p>
			</div>
			<!-- Company info -->
			<div class="topsearch">
				<input type="text" placeholder="Tìm kiếm" value="" class="" id="" name="" />
				<input type="submit" class="btn-search" value="" id="" name""/>
			</div>
			<?php 
			$sections = (object)Yii::app()->params->sections;
			$selecttitle = Yii::app()->request->getParam('selecttitle');
			$cart = Yii::app()->session->readSession('cart');
			$count = 0;
			if(!empty($cart)){
				$cart = json_decode($cart);
				$count = count($cart);				
			}
			?>
			<div id="cart"> <img width="28" height="36" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/iconcart.png">
		      <p><strong><a href="#">XEM GIỎ HÀNG</a></strong> <br>
		        Có <strong><?php echo $count;?></strong> sản phẩm</p>
		    </div>
			<?php $this->beginContent('//layouts/_partials/menu'); ?><?php $this->endContent(); ?>
		</div>
		<!-- header -->
		<?php $this->widget('frontend.widgets.WSlider'); ?>
		<!-- slider -->
		<div class="main">
			<?php echo $content; ?>
		</div>
		<!-- main content -->
	</div>
	<!-- wrapper -->
	<div class="footer">
		<div class="ft-wrap clearfix">
			<div class="ft-left">
				<span class="arrow"><?php echo Yii::app()->name;?></span>
				<p>1333/7A Khu Phố Đông Thành, Phường Tân Đông Hiệp,<br/>
				Thị Xã Dĩ An, Tỉnh Bình Dương, Việt Nam</p>
				<span class="arrow">Tel: 0650 3775427</span>
				<span class="arrow">Hotline: 016 99 2222 9967</span>
			</div>
			<div class="ft-right">
				<ul class="clearfix">
					<li><a href="#">Trang chủ</a></li></li>
					<li>|</li>
					<li><a href="#">Giới thiệu</a></li>
					<li>|</li>
					<li><a href="#">Sản phẩm</a></li>
					<li>|</li>
					<li><a href="#">Dịch vụ</a></li>
					<li>|</li>
					<li><a href="#">Tin tức</a></li>
					<li>|</li>
					<li><a href="#">Liên hệ</a></li>
				</ul>
				<p>Copyright &copy; 2012 <a href="http://thiendiep.com" title="<?php echo Yii::app()->name;?>">www.thiendiep.com</a></p>
				<p>Website thực hiện bởi <a href="#" title="Panda Nguyen">Panda Nguyen</a></p>
			</div>
		</div>
	</div>
</body>
</html>