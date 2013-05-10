<div class="subpage_cont">
	<div class="left-content">
		<div class="menu-left-wrap">
			<div class="menu-left">
				<?php $this->widget('frontend.widgets.WProduct', array('view'=>'sale_fast')); ?>
			</div>
		</div>
	</div>
	<div class="right-content">
		<div class="subpage_cont">
			<h2>DỊCH VỤ</h2>
			<div class="news">
			  <?php 
			  if(!empty($content)):
			  ?>
			  <ul class="listNews">
			  <?php 
			  	foreach ($content as $item) {
			  		$src = Yii::app()->theme->baseUrl.'/resources/images/no_photo.jpg';
			  		if(!empty($item->images) && is_file(Yii::getPathOfAlias('pathroot').$item->images)){
			  			$src = $item->images;
			  		}
			  ?>
			  <li>
			  <a class="news-thumb" href="<?php echo Yii::app()->createUrl('services/view', array('id'=>$item->id, 'slug'=>$item->slug))?>">
					<img src="<?php echo Yii::app()->createUrl($src);?>" alt="" title="" width="201" height="147" />
					<span><?php echo $item->title;?></span>							 
				</a>
				<p><?php echo Util::partString(strip_tags($item->introtext), 0, 100);?></p>
				<span class="date">Cập nhật lúc: <?php echo date("l - d/m/Y", $item->created);?></span>
			  </li>
			  <?php 
			  	}
			  ?>
			  </ul>
			  <?php
			  	endif;
			  ?>
			  <div class="clearb"></div>
			  <!-- .paging -->
			  <?php if(!empty($pages)):?>
			  <div class="paging"> <?php $this->widget('backend.extensions.ExtLinkPager', array('pages' => $pages,)); ?> </div>
			  <?php endif;?>
			  <div class="content-footer"></div>  
			</div>
		</div>
	</div>
</div>