<?php
/* @var $this OfficetimeController */
/* @var $model Officetime */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'officetime-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name_time'); ?>
		<?php echo $form->textField($model,'name_time',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'name_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'must_in'); ?>
		<?php echo $form->textField($model,'must_in'); ?>
		<?php echo $form->error($model,'must_in'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'must_out'); ?>
		<?php echo $form->textField($model,'must_out'); ?>
		<?php echo $form->error($model,'must_out'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'limit_in_start'); ?>
		<?php echo $form->textField($model,'limit_in_start'); ?>
		<?php echo $form->error($model,'limit_in_start'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'limit_in_last'); ?>
		<?php echo $form->textField($model,'limit_in_last'); ?>
		<?php echo $form->error($model,'limit_in_last'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'limit_out_start'); ?>
		<?php echo $form->textField($model,'limit_out_start'); ?>
		<?php echo $form->error($model,'limit_out_start'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'limit_out_last'); ?>
		<?php echo $form->textField($model,'limit_out_last'); ?>
		<?php echo $form->error($model,'limit_out_last'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->