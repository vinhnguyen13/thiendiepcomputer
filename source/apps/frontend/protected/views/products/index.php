<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<div class="subpage_cont">
	<div class="left-content">
		<div class="menu-left-wrap">
			<div class="menu-left">
				<?php $this->widget('frontend.widgets.WCategories'); ?>
			</div>
		</div>
	</div>
	<div class="right-content">
		<div class="product">
			<div class="product-cat-title">
				<a title="Contrary to popular belief  category 1" href="#">Contrary to popular belief  category 1</a>
			</div>					
			<div class="product-cate-block">
				<?php if(!empty($products)):?>
				<ul class="prod-cat-list">
				<?php 
				  	foreach ($products as $item) {
				  		$src = Yii::app()->theme->baseUrl.'/resources/images/no_photo.jpg';
				  		if(!empty($item->images) && is_file(Yii::getPathOfAlias('pathroot').$item->images)){
				  			$src = $item->images;
				  		}
				  		$price = 0;
				  		if(!empty($item->price)){
				  			$price = number_format($item->price);
				  		}
				  		$price_new = 0;
						if(!empty($item->price_new)){
							$price_new = number_format($item->price_new);
						}
				  		$url = Yii::app()->createUrl('products/view', array('id'=>$item->id, 'slug'=>$item->slug));
				  ?>
					<li>	
						<a href="<?php echo $url;?>" class="pro-thumb">
							<img width="201" height="147" title="" alt="" src="<?php echo $src;?>">
						</a>
						<h4><a href="<?php echo $url;?>"><span><?php echo $item->title;?></span></a></h4>
						<p><?php echo Util::partString(strip_tags($item->introtext), 0, 100);?></p>
						<div class="pro-task">
							<a href="<?php echo $url;?>" class="btn-more-1">Chi tiết</a>
							<a href="<?php echo $url;?>" class="btn-cat"></a>
						</div>
					</li>
					<?php 
				  	}
				  ?>			
				</ul>
				<?php if(!empty($pages)):?>
			    <div class="paging1"> 
			      <?php $this->widget('backend.extensions.ExtLinkPager', array('pages' => $pages,)); ?> 
			      </div>
			    <?php endif;?>
				<?php endif;?>
			</div>
		</div>
	</div>
</div>
