<?php
/* @var $this CardlsfController */
/* @var $model Cardlsf */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cardlsf-form',
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
		<?php echo $form->labelEx($model,'emp_id'); ?>
		<?php echo $form->textField($model,'emp_id',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'emp_id'); ?>
	</div>

	<?php 
		//echo "date". date("Y-m-d");
	$model->date_create= date('Y-m-d');
		?>
	</div>
	<div class="row">	
		<?php echo $form->labelEx($model,'emp_id'); ?>
		<?php //echo $form->textField($model,'emp_id',array('size'=>15,'maxlength'=>15)); 	);?>
		<?php 
			echo $form->dropDownList($model,'emp_id',
				CHtml::listdata(Emp::model()->findAll(),'id','name'),
				array('empty'=>'Select a emp'));?>
		<?php echo $form->error($model,'emp_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_create'); ?>
		<?php echo $form->textField($model,'date_create'); ?>
		<?php echo $form->error($model,'date_create'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_create'); ?>
		<?php echo $form->textField($model,'date_create', array('readOnly'=>($model->scenario =='create')?true:false)); ?>
		<?php echo $form->error($model,'date_create'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sensorid'); ?>
		<?php echo $form->textField($model,'sensorid'); ?>
		<?php echo $form->error($model,'sensorid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->