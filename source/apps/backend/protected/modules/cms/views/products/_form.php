<?php
/* @var $this ProductsController */
/* @var $model Products */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'products-form',
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
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
		<?php echo $form->error($model,'amount'); ?>
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

	<?php echo $form->hiddenField($model, 'sectionid', array('value'=>$this->sections->products)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'catid'); ?>
		<?php echo $form->dropDownList($model, 'catid', CHtml::listData(Categories::model()->findAll(), 'id', 'title'), array('prompt'=>'- Select a Category -')); ?>
		<?php echo $form->error($model,'catid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'published'); ?>
		<?php echo $form->dropDownList($model, 'published', array(0 => Yii::t(null,'No'),1 => Yii::t(null,'Yes'))); ?>
		<?php echo $form->error($model,'published'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'new'); ?>
		<?php echo $form->dropDownList($model, 'new', array(0 => Yii::t(null,'No'),1 => Yii::t(null,'Yes'))); ?>
		<?php echo $form->error($model,'new'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'promotions'); ?>
		<?php echo $form->dropDownList($model, 'promotions', array(0 => Yii::t(null,'No'),1 => Yii::t(null,'Yes'))); ?>
		<?php echo $form->error($model,'promotions'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'fast_selling'); ?>
		<?php echo $form->dropDownList($model, 'fast_selling', array(0 => Yii::t(null,'No'),1 => Yii::t(null,'Yes'))); ?>
		<?php echo $form->error($model,'fast_selling'); ?>
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

	<div class="row">
		<?php echo $form->labelEx($model,'ordering'); ?>
		<?php echo $form->textField($model,'ordering'); ?>
		<?php echo $form->error($model,'ordering'); ?>
	</div>
	
	
	<?php 
	/** end **/
	?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->