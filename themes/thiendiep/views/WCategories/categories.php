<h3>danh mục sản phẩm</h3>
<div class="menu-left-inner">
<?php if(!empty($categories[0])):?>
	<ul class="menu-left-list">
		<?php foreach ($categories[0] as $key=>$cat):?>
		<?php 
		$childs = null;
        if(!empty($categories[$cat['item']->id])){
        	$childs = $categories[$cat['item']->id];
        }
		?>
		<li>
			<a title="<?php echo $cat['item']->title;?>" href="<?php echo Yii::app()->createUrl('products/index', array('catid'=>$cat['item']->id, 'cslug'=>$cat['item']->slug))?>"><?php echo $cat['item']->title;?></a>
			<?php if (!empty($childs)):?>
			<ul class="menu-left-sub">
				<?php foreach ($childs as $k=>$child):?>
					<li><a title="Keltec common kit" href="<?php echo Yii::app()->createUrl('products/index', array('catid'=>$child['item']->id, 'cslug'=>$child['item']->slug))?>" class="current"><?php echo $child['item']->title;?></a></li>
				<?php endforeach;?>
			</ul>
			<?php endif;?>
		</li>
		<?php endforeach;?>
	</ul>
<?php endif;?>
</div>