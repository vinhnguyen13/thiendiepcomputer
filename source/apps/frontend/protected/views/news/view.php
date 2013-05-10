<?php
/* @var $this SiteController */
?><div class="subpage_cont">
	<div class="left-content">
		<div class="menu-left-wrap">
			<div class="menu-left">
				<?php $this->widget('frontend.widgets.WProduct', array('view'=>'sale_fast')); ?>
			</div>
		</div>
	</div>
	<div class="right-content">
		<div class="subpage_cont">
			<ul class="breadcrumd">
				<li class="home"><a href="#" title="Home">Home</a></li>
				<li><a href="#" title="News">Tin tức</a></li>
				<li>PC chơi game Alienware X51 chạy hệ điều hành Ubuntu</li>
			</ul>
			
			
			<div class="newsDetail">
				<h2><?php echo $content->title;?></h2>
				<span class="date">Cập nhật lúc: <?php echo date("l - d/m/Y", $content->created);?></span>
				<div class="newsCont contentEditor">
					<?php echo $content->fulltext;?>
				</div>
			</div>
			<!-- contact-->
		</div>
	</div>
</div>
