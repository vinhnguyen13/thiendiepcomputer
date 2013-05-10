<div class="menu-left">
        <h2><img src="<?php echo Yii::app()->theme->baseUrl; ?>/resources/images/icon1.png" alt=""/>Danh mục sản phẩm</h2>
        <div class="glossymenu"> 
        <?php if(!empty($categories[0])):?>
        <?php foreach ($categories[0] as $key=>$cat):?>
        	<?php 
        	$childs = null;
        	if(!empty($categories[$cat['item']->id])){
        		$childs = $categories[$cat['item']->id];
        	}
        	$cls = null;
        	if(!empty($childs)){
        		$cls = ' submenuheader';
        	}
        	?>
			<a class="menuitem<?php echo $cls;?>" href="<?php echo Yii::app()->createUrl('products/index', array('catid'=>$cat['item']->id, 'cslug'=>$cat['item']->slug))?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/resources/images/ball.png" alt="" class="ball" /><?php echo $cat['item']->title;?></a> 
        	<?php if (!empty($childs)):?>
        		<div class="submenu">
		            <ul>
		            <?php foreach ($childs as $k=>$child):?>
		              <li><a href="<?php echo Yii::app()->createUrl('products/index', array('catid'=>$child['item']->id, 'cslug'=>$child['item']->slug))?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/resources/images/arrow-right1.png" alt="" class="ball"/><?php echo $child['item']->title;?></a></li>
	              	<?php endforeach;?>
		            </ul>
		          </div>
        	<?php endif;?>       
          <?php endforeach;?>
          <?php endif;?>
          </div>
        <div class="bg-menu-footer"></div>
      </div>