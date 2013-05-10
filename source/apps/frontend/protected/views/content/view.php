<?php
/* @var $this SiteController */
?>
<div class="block-content-small">
	<div class="title">Tin tức</div>
	
	<!--  .content-detail --> 
	<div class="content-detail">
	<h1><?php echo $content->title;?></h1>
	<h3><?php echo date("l - d/m/Y", $content->created);?></h3>
	<?php echo $content->fulltext;?>
	</div>
	<!-- End .content-detail --> 
	<div class="clearb"></div>	
	
	<!-- .othernews --> 
	<div class="othernews">
	<h2>Các Tin khác</h2>
	<ul>
	<li><a href="#"><img alt="" src="images/image27.jpg"></a> <strong><a href="#">Nam liber tempor cum soluta nobis eleifend</a></strong><br>Thứ 6 - 9/11/2012 </li>
	<li><a href="#"><img alt="" src="images/image28.jpg"></a> <strong><a href="#">Nam liber tempor cum soluta nobis eleifend</a></strong><br>Thứ 6 - 9/11/2012 </li>
	<li><a href="#"><img alt="" src="images/image29.jpg"></a> <strong><a href="#">Nam liber tempor cum soluta nobis eleifend</a></strong><br>Thứ 6 - 9/11/2012 </li>
	<li><a href="#"><img alt="" src="images/image30.jpg"></a> <strong><a href="#">Nam liber tempor cum soluta nobis eleifendNam liber tempor cum soluta </a></strong><br>Thứ 6 - 9/11/2012 </li>
	<li><a href="#"><img alt="" src="images/image31.jpg"></a> <strong><a href="#">Nam liber tempor cum soluta nobis eleifend</a></strong><br>Thứ 6 - 9/11/2012 </li>
	<li><a href="#"><img alt="" src="images/image32.jpg"></a> <strong><a href="#">Nam liber tempor cum soluta nobis eleifend</a></strong><br>Thứ 6 - 9/11/2012 </li>
	</ul>
	</div>
	<!-- End .othernews --> 

	<div class="content-footer"></div>
</div>


