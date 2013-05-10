<?php
/* @var $this ContentController */
/* @var $model Content */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'content-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'introtext'); ?>
		<?php 
		$this->widget('application.extensions.cleditor.ECLEditor', array(
	        'model'=>$model,
	        'attribute'=>'introtext', //Model attribute name. Nome do atributo do modelo.
	        'options'=>array(
	            'width'=>'600',
	            'height'=>250,
	            'useCSS'=>true,
	        ),
	    ));
		?>
		<?php echo $form->error($model,'introtext'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fulltext'); ?>
		<?php 
		$this->widget('application.extensions.cleditor.ECLEditor', array(
	        'model'=>$model,
	        'attribute'=>'fulltext', //Model attribute name. Nome do atributo do modelo.
	        'options'=>array(
	            'width'=>'600',
	            'height'=>250,
	            'useCSS'=>true,
	        ),
	    ));
		?>
		<?php echo $form->error($model,'fulltext'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'home'); ?>
		<?php echo $form->dropDownList($model, 'home', array(0 => Yii::t(null,'No'),1 => Yii::t(null,'Yes'))); ?>
		<?php echo $form->error($model,'home'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'published'); ?>
		<?php echo $form->dropDownList($model, 'published', array(0 => Yii::t(null,'No'),1 => Yii::t(null,'Yes'))); ?>
		<?php echo $form->error($model,'published'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'images'); ?>
		<?php echo CHtml::fileField('images'); ?>
		<?php echo $form->error($model,'images'); ?>
	</div>
	
	<div class="row">
		<?php 
		if(!empty($model->images)){
			$baseUrl = str_replace('admin', '', Yii::app()->createAbsoluteUrl('/') );
			echo CHtml::image($baseUrl .$model->images, $model->title, array("class" => "gImg", "title" => $model->title, "width"=>"70"));
		}
		?>
	</div>

	<?php echo $form->hiddenField($model, 'sectionid', array('value'=>$this->sections->introduction)); ?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->