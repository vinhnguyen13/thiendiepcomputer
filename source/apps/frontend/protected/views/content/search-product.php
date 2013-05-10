<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<div class="block-content-large content-margin"> 
	  <h2>Tìm kiếm</h2>
	  <!--.items-content -->
	  <div class="items-content">
	  	<?php 
		  if(!empty($products)):
		  	foreach ($products as $item) {
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
	    <div class="items">
	    <?php if(!empty($item->promotions)):?>
	    	<span class="khuyenmai"></span> 
	    <?php endif;?>
	    <?php if(!empty($item->new)):?>
	    	<span class="new-pro"></span> 
	    <?php endif;?>
	    <a href="<?php echo $url;?>"><img src="<?php echo $src;?>" alt="" width="153" height="120" /></a><br />
	      <strong class="blue"><a href="<?php echo $url;?>"><?php echo $item->title;?></a></strong><br />
	      <br />
	      <strong>Giá:</strong> <strong class="red"><?php echo $price;?> VNĐ</strong> </div>
	    <?php 
		  	}
		  	endif;
		  ?>
	    <div class="clearb"></div>
	    
	    <!-- .paging1 -->
	    <div class="paging1"> 
	      <!--.showinfo -->
	      <div class="showinfo"> <strong>Hiển thị</strong>
	        <div class="seclectpage-wrap">
	          <select name="seclectpage" id="seclectpage">
	            <option>1</option>
	            <option>2</option>
	            <option>3</option>
	          </select>
	        </div>
	      </div>
	      <!--End .showinfo --> 
	      
	      <?php $this->widget('backend.extensions.ExtLinkPager', array('pages' => $pages,)); ?> 
	      </div>
	    <!-- End .paging1 --> 
	    
	  </div>
	  <!--ENd .items-content -->
	  
	  <div class="content-footer"></div>
	</div>