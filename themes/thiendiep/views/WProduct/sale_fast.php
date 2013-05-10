<h3>Sản phẩm bán chạy</h3>
<div class="menu-left-inner">
<?php if(!empty($products)){?>
	<ul class="menu-left-list">
		<?php foreach ($products as $item){?>
		<?php 
		$src = Yii::app()->theme->baseUrl.'/resources/images/no_photo.jpg';
		if(!empty($item->images) && is_file(Yii::getPathOfAlias('pathroot').$item->images)){
			$src = $item->images;
		}
		$price = 0;
		if(!empty($item->price)){
			$price = number_format($item->price);
		}
		$url = Yii::app()->createUrl('products/view', array('id'=>$item->id, 'slug'=>$item->slug));
		?>
		<li>
		<a href="<?php echo $url;?>"><img style="max-width: 100px; max-height: 100px;" src="<?php echo $src;?>" alt="" /></a>
		<strong class="blue"><?php echo $item->title; ?></strong>
		</li>
		<?php }?>
	</ul>
<?php }?>							
</div>