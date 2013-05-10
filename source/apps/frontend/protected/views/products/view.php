<?php
/* @var $this SiteController */
$src = Yii::app()->theme->baseUrl.'/resources/images/no_photo.jpg';
if(!empty($product->images) && is_file(Yii::getPathOfAlias('pathroot').$product->images)){
	$src = Yii::app()->createAbsoluteUrl($product->images);
}
$params = json_decode($product->params);
$price = 0;
if(!empty($product->price)){
	$price = number_format($product->price);
}
$price_new = 0;
if(!empty($product->price_new)){
	$price_new = number_format($product->price_new);
}
$clsAmount = '';
if(empty($product->amount)){
	$clsAmount = ' out-of-stock';
}
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
		<?php if(isset($breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$breadcrumbs,
			'htmlOptions'=>array('class'=>'breadcrumd'),
			'tagName'=>'ul', // will change the container to ul
	        'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>', // will generate the clickable breadcrumb links 
	        'inactiveLinkTemplate'=>'<li>{label}</li>', // will generate the current page url : <li>News</li>
	        'homeLink'=>'<li class="home"><a href="#" title="Home">Home</a></li>',
			'separator'=>'',
		)); ?><!-- breadcrumbs -->
		<?php endif?>
		<div class="product-cate-block">
			<div class="products-detail">
				<div class="product-details-inner">
					<div class="photos-2" style="width: 340px;">
						<div class="photos-visual">
							<div class="photos-zoom">
								<a title="Tên sản phẩm" href="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_visual_3_large.jpg" class="zoom-product">
									<img width="299" height="218" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_visual_3.jpg" alt="">
								</a>
							</div> 
						</div>
<!--						
						<div id="list-pro-thumb" class="list-thumbs-3">
							<div class="list-thumbs-3-inner lstContent">
								<ul style="margin-top: -73px;">
									<li class="">
										<a rel="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_visual_1_large.jpg" href="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_visual_1.jpg">
											<img width="88" height="65" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_thumb_1.jpg" alt="">
										</a>
									</li>
									<li class="">
										<a rel="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_visual_2_large.jpg" href="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_visual_2.jpg">
											<img width="88" height="65" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_thumb_2.jpg" alt="">
										</a>
									</li>
									<li class="current">
										<a rel="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_visual_3_large.jpg" href="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_visual_3.jpg">
											<img width="88" height="65" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_thumb_3.jpg" alt="">
										</a>
									</li>
									<li>
										<a rel="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_visual_1_large.jpg" href="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_visual_1.jpg">
											<img width="88" height="65" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_thumb_1.jpg" alt="">
										</a>
									</li>
									<li>
										<a rel="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_visual_2_large.jpg" href="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_visual_2.jpg">
											<img width="88" height="65" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_thumb_2.jpg" alt="">
										</a>
									</li>
									<li>
										<a rel="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_visual_3_large.jpg" href="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_visual_3.jpg">
											<img width="88" height="65" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_thumb_3.jpg" alt="">
										</a>
									</li>
									<li>
										<a rel="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_visual_2_large.jpg" href="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_visual_2.jpg">
											<img width="88" height="65" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_thumb_2.jpg" alt="">
										</a>
									</li>
									<li>
										<a rel="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_visual_3_large.jpg" href="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_visual_3.jpg">
											<img width="88" height="65" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/pro_thumb_3.jpg" alt="">
										</a>
									</li>
								</ul>
							</div>
							<div class="list-thumbs-3-button">
								<span class="btn-up"><a href="#" style="opacity: 1; cursor: pointer;"><img width="5" height="5" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/btn-up.gif"></a></span>
								<span class="btn-down"><a href="#" style="opacity: 1; cursor: pointer;"><img width="5" height="5" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/btn-down.gif"></a></span>
							</div>
						</div>
						-->
					</div>
					<div class="product-info-3" style="float: left;">
						
							<h3><?php echo $product->title;?></h3>
							<div class="product-info-des">
								<p>Không khí chúng ta đang thở cũng mang chất ô nhiễm. Các hạt bụi trong không khí, nước, vi khuẩn và các chất hóa học sẽ đi vào máy nén khí.</p>						 
							</div>
							<div class="pro-feature">
								 <p><span class="feature-label">Cấp lọc:</span>        (0.1 &ndash; 0.2 &ndash; 0.45 - 1) micron.</p> 
								 <p><span class="feature-label">Vật liệu lọc: </span>         PTFE. </p>
								 <p><span class="feature-label">Vật liệu lọc: </span>         0.77 m2/10"</p> 
								 <p><span class="feature-label">Nhiệt độ làm việc tới: </span>        700C</p>
							</div>
							<!--							
							<div class="orders">
								<form action="#" id="product-order" name="product-order" class="frm-pro-detail">
									<label for="txt-quatity">Số lượng:</label>
									<input type="text" name="txt-quatity" id="txt-quatity" value="1" class="txt-quantity">
									<input type="hidden" name="txt-product-code" id="txt-product-code" value="pro-code-1">
									<input type="submit" class="btn-buy" name="btn-submit" id="btn-submit" value="Đặt mua">
								 </form>
							</div>
							-->
					</div>
					<div class="product-full tabContainer">
						<ul class="tabToggle" id="tabFeatures">
							<li><a href="#" class="active"><span>Giới thiệu chung</span></a></li>
							<li><a href="#" class=""><span>Đặc tính</span></a></li>
							<li><a href="#" class=""><span>Thông số kỹ thuật</span></a></li>
						</ul>                
						<div class="tab-pro-intro tabContent contentEditor">
							<p>Không khí chúng ta đang thở cũng mang chất ô nhiễm. Các hạt bụi trong không khí, nước, vi khuẩn và các chất hóa học sẽ đi vào máy nén khí. Tại mỗi trạng thái, các chất ô nhiễm này trở nên tập trung và gây hư hại nhiều hơn.</p>
							<p>Trong hệ thống khí nén, các phần tử hạt cứng đó sẽ ảnh hưởng đến các thiết bị và hệ thống đường ống. Kết quả là sẽ làm phá hủy hệ thống gây ra nhiều các phần tử ô nhiễm hơn. Có thể kể đến các phân tử được tìm thấy trong hệ thống khí nén như ô xít kim loại, chất bẩn. Các phần tử trong 1 hệ thống khí nén có thể<br>
							</p>
							<p><img width="344" height="258" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/img_cont_1.jpg" style="margin-right:10px;"><img width="346" height="260" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/img_cont_2.jpg"></p>
							<p>Hệ thống khí nén chứa hạt bụi,phun xịt và tập trung.khí nén được bão hòa với nước.khí nén được làm nóng trong suốt quá trình nén sau đó được thoát bớt nhiệt nhờ hệ thống làm mát. <br>
								<br>
								Các khí hóa học,có thể 1 mình hoặc kết hợp với các chất ô nhiễm khác gây ra hư hại hoặc tạo ra các mối nguy hiểm tiềm tàng cho quá trình.Khí hóa học được tìm thấy trong hệ thống khí nén bao gồm: <br>
								- Chất làm lạnh.<br>
							</p>
						</div>
						<div class="tab-pro-feature tabContent hidden">
							<table width="100%" cellspacing="0" cellpadding="0" border="0" class="tbl01 tblType01">
								<tbody>
									<tr>
										<td class="cellType01"> met</td>
										<td>Màu sơn có ánh kim</td>
									</tr>
									<tr>
										<td class="cellType01"> 9A2</td>
										<td> Chức năng runflat</td>
									</tr>
									<tr>
										<td class="cellType01"> 258</td>
										<td> Mâm hợp kim nan hình chữ V kiểu 236, 17 inch</td>
									</tr>
									<tr>
										<td class="cellType01"> 2K1</td>
										<td> Nội thất với da tổng hợp</td>
									</tr>
									<tr>
										<td class="cellType01"> K8</td>
										<td> Ốp nội thất vân mờ</td>
									</tr>
									<tr>
										<td class="cellType01"> 4AT</td>
										<td> Chức năng Start/Stop tự động</td>
									</tr>
									<tr>
										<td class="cellType01"> 1CC</td>
										<td> Hệ thống phanh tái sinh năng lượng</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="tab-pro-spec tabContent hidden">
							<table width="100%" cellspacing="0" cellpadding="0" border="0" class="tbl01 tblType01">
								<tbody>
									<tr>
										<td class="cellType01"> 1CD</td>
										<td> Hộp số tự động 8 cấp</td>
									</tr>
									<tr>
										<td class="cellType01"> 205</td>
										<td> Hệ thống kiếm soát cự ly đỗ xe (PDC) (incl. in 9A2)</td>
									</tr>
									<tr>
										<td class="cellType01"> 508</td>
										<td> Gương trong &amp; ngoài xe tự điều chỉnh chống chói (incl. in A92)</td>
									</tr>
									<tr>
										<td class="cellType01"> 430</td>
										<td> Gương chiếu hậu trong xe tự điều chỉnh chống chói</td>
									</tr>
									<tr>
										<td class="cellType01"> 431</td>
										<td> Đèn Xê-non với chức năng điều chỉnh ánh sáng chiếu gần &amp; xa</td>
									</tr>
									<tr>
										<td class="cellType01"> 522</td>
										<td> Ghế trước chỉnh điện với chế độ nhớ (incl. in A92)</td>
									</tr>
									<tr>
										<td class="cellType01"> 459</td>
										<td> Thảm sàn ( trang bị tại Việt Nam)</td>
									</tr>
									<tr>
										<td class="cellType01"> 423</td>
										<td> Trang bị gạt tàn thuốc  và mồi lửa</td>
									</tr>
									<tr>
										<td class="cellType01"> 441</td>
										<td> Hệ thống đèn dọc thân xe</td>
									</tr>
									<tr>
										<td class="cellType01"> 4UK</td>
										<td> Lỗ cắm điện công suất 12V</td>
									</tr>
									<tr>
										<td class="cellType01"> 575</td>
										<td> Đồng hồ hiển thị số km</td>
									</tr>
									<tr>
										<td class="cellType01"> 699</td>
										<td> Chức năng đọc đĩa dành cho khu vực Châu Á</td>
									</tr>
									<tr>
										<td class="cellType01"> 825</td>
										<td> Điều chỉnh sóng âm thanh</td>
									</tr>
									<tr>
										<td class="cellType01"> 8S3</td>
										<td> Chức năng tự động lock cửa khi xe vận hành</td>
									</tr>
								</tbody>
							</table>
						</div>		
					</div>
				</div>
			</div>
		</div>
		<?php if(!empty($products)){?>
		<div id="relate-products" class="product-cate-block">
			<div class="product-cat-title">
				<h3>Những sản phẩm khác</h3>
			</div>
			<div class="products-content">
					<p class="btn-prev"> <a href="#"><img width="7" height="9" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/btn-prev-2.gif"></a> </p>
				  <div class="list-products-2">
						<ul>
							<?php foreach ($products as $item):
								$src = Yii::app()->theme->baseUrl.'/resources/images/no_photo.jpg';
						  		if(!empty($item->images) && is_file(Yii::getPathOfAlias('pathroot').$item->images)){
						  			$src = $item->images;
						  		}
								$url = Yii::app()->createUrl('products/view', array('id'=>$item->id, 'slug'=>$item->slug));
							?>
							<li>	
								<a href="#" class="pro-thumb">
									<img width="139" height="101" title="" alt="" src="<?php echo $src;?>">
								</a>
								<h4><a href="<?php echo $url;?>"><span><?php echo $item->title;?></span></a></h4>										
							</li>
							<?php endforeach;?>
						</ul>
					</div>
					<p class="btn-next"><a href="#"><img width="7" height="9" alt="" src="<?php echo Yii::app()->theme->baseUrl; ?>/resource/images/btn-next-2.gif"> </a></p>						
				</div>
		</div>
		<?php }?>
	</div>
</div>