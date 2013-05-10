<?php
/* @var $this AdvertisingController */
/* @var $model Advertising */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'advertising-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model, 'type', array('image' => Yii::t(null,'Image'),'flash' => Yii::t(null,'Flash'))); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'position'); ?>
		<?php echo $form->dropDownList($model, 'position', array('left' => Yii::t(null,'Left'),'right' => Yii::t(null,'Right'),'slide' => Yii::t(null,'Slide'))); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'file_path'); ?>
		<?php echo CHtml::fileField('file_path'); ?>
		<?php echo $form->error($model,'file_path'); ?>
	</div>
	
	<div class="row">
		<?php 
		$baseUrl = str_replace('admin', '', Yii::app()->createAbsoluteUrl('/') );
		if(!empty($model->file_path) && $model->type=='image'){
			echo CHtml::image($baseUrl .$model->file_path, $model->title, array("class" => "gImg", "title" => $model->title, "width"=>"70"));
		}elseif ($model->file_path && $model->type=='flash'){
		?>
			<embed allowscriptaccess="always" wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" src="<?php echo $baseUrl.$model->file_path; ?>">
		<?php 	
		}
		?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'params'); ?>
		<?php echo $form->textArea($model,'params',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'params'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'order'); ?>
		<?php echo $form->textField($model,'order'); ?>
		<?php echo $form->error($model,'order'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'published'); ?>
		<?php echo $form->dropDownList($model, 'published', array(0 => Yii::t(null,'No'),1 => Yii::t(null,'Yes'))); ?>
		<?php echo $form->error($model,'published'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->