<?php
/* @var $this OutareaController */
/* @var $model Outarea */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'keperluan'); ?>
		<?php echo $form->textField($model,'keperluan',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datestart'); ?>
		<?php echo $form->textField($model,'datestart'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dateend'); ?>
		<?php echo $form->textField($model,'dateend'); ?>
	</div>

	<div class="row">
		<?php //echo $form->label($model,'datearray'); ?>
		<?php //echo $form->textArea($model,'datearray',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->