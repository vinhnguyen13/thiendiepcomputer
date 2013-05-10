<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>
<div class="subpage_cont">
	<div class="contact">
		<div class="info-contact-us">
			<h2>Địa chỉ liên hệ</h2>
			<h3 class="arrow"><?php echo Yii::app()->name;?></h3>
			<p>1333/7A Khu Phố Đông Thành, Phường Tân Đông Hiệp, <br/>Thị Xã Dĩ An, Tỉnh Bình Dương, Việt Nam</p>
			<span class="arrow">Tel: 0650 3775427</span>
			<span class="arrow">Hotline: 016 99 2222 9967</span>
			<div id="googleMapWrap">
				<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/?ie=UTF8&amp;ll=10.919028,106.769857&amp;spn=0.021491,0.042272&amp;t=h&amp;z=15&amp;output=embed"></iframe>
			</div>
		</div>
		<div class="form-contact-us">
			<h2>Form Liên hệ</h2>
			
			<?php if(Yii::app()->user->hasFlash('contact')): ?>
			<div class="flash-success">
				<?php echo Yii::app()->user->getFlash('contact'); ?>
			</div>
			<?php else: ?>
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'contact-form',
				'enableClientValidation'=>true,
				'clientOptions'=>array(
					'validateOnSubmit'=>true,
				),
			)); ?>
				<p class="note">Fields with <span class="required">*</span> are required.</p>
				<?php echo $form->errorSummary($model); ?>
				<div class="row">
					<?php echo $form->labelEx($model,'name'); ?>
					<?php echo $form->textField($model,'name'); ?>
					<?php echo $form->error($model,'name'); ?>
				</div>
				<div class="row">
					<?php echo $form->labelEx($model,'email'); ?>
					<?php echo $form->textField($model,'email'); ?>
					<?php echo $form->error($model,'email'); ?>
				</div>
				<div class="row">
					<?php echo $form->labelEx($model,'subject'); ?>
					<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
					<?php echo $form->error($model,'subject'); ?>
				</div>
				<div class="row">
					<?php echo $form->labelEx($model,'body'); ?>
					<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
					<?php echo $form->error($model,'body'); ?>
				</div>
				<?php if(CCaptcha::checkRequirements()): ?>
				<div class="row">
					<?php echo $form->labelEx($model,'verifyCode'); ?>
					<div style="float: left;">
					<?php $this->widget('CCaptcha'); ?>
					<?php echo $form->textField($model,'verifyCode'); ?>
					</div>
					<?php echo $form->error($model,'verifyCode'); ?>
				</div>
				<?php endif; ?>
			
				<div class="row buttons" style="padding-bottom: 20px;">
					<div class="field">
						<?php echo CHtml::submitButton('Submit', array('class'=>'button-submit')); ?>
						<?php echo CHtml::resetButton('Reset', array('class'=>'button-reset')); ?>
					</div>
					<div class="clear"></div>
				</div>
			
			<?php $this->endWidget(); ?>
			
			
			<?php endif; ?>
			
		</div>
	</div>
	<!-- contact-->
</div>

