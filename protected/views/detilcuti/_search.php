<?php
/* @var $this DetilcutiController */
/* @var $model Detilcuti */
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
		<?php echo $form->label($model,'cuti_id'); ?>
		<?php echo $form->textField($model,'cuti_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cuti_emp_id'); ?>
		<?php echo $form->textField($model,'cuti_emp_id',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kodecuti_id'); ?>
		<?php echo $form->textField($model,'kodecuti_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_cuti'); ?>
		<?php echo $form->textField($model,'date_cuti'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->