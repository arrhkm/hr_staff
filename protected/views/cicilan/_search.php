<?php
/* @var $this CicilanController */
/* @var $model Cicilan */
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
		<?php echo $form->label($model,'no_angsuran'); ?>
		<?php echo $form->textField($model,'no_angsuran'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_cicil'); ?>
		<?php echo $form->textField($model,'date_cicil'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'value_cicil'); ?>
		<?php echo $form->textField($model,'value_cicil',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kasbon_id'); ?>
		<?php echo $form->textField($model,'kasbon_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->