<?php
/* @var $this OfficetimeController */
/* @var $model Officetime */
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
		<?php echo $form->label($model,'name_time'); ?>
		<?php echo $form->textField($model,'name_time',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'must_in'); ?>
		<?php echo $form->textField($model,'must_in'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'must_out'); ?>
		<?php echo $form->textField($model,'must_out'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'limit_in_start'); ?>
		<?php echo $form->textField($model,'limit_in_start'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'limit_in_last'); ?>
		<?php echo $form->textField($model,'limit_in_last'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'limit_out_start'); ?>
		<?php echo $form->textField($model,'limit_out_start'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'limit_out_last'); ?>
		<?php echo $form->textField($model,'limit_out_last'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->