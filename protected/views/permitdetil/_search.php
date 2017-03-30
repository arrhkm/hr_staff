<?php
/* @var $this PermitdetilController */
/* @var $model Permitdetil */
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
		<?php echo $form->label($model,'date_permit'); ?>
		<?php echo $form->textField($model,'date_permit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'permit_id'); ?>
		<?php echo $form->textField($model,'permit_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'permit_emp_id'); ?>
		<?php echo $form->textField($model,'permit_emp_id',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'permitcode_id'); ?>
		<?php echo $form->textField($model,'permitcode_id',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->