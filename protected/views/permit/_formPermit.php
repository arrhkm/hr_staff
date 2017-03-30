<?php
/* @var $this PermitController */
/* @var $model Permit */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'permit-_formPermit-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id', array('readOnly'=>true)); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'emp_id'); ?>
		<?php 
			//echo $form->textField($model,'emp_id'); 
			$list= CHtml::listData(Emp::model()->findAll(array('order'=>'name ASC')), 'id', 'name');
			echo $form->dropDownList($model, 'emp_id', $list, array('empty'=>'-- none --'));
		?>
		<?php echo $form->error($model,'emp_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'need'); ?>
		<?php echo $form->textField($model,'need'); ?>
		<?php echo $form->error($model,'need'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'describe_need'); ?>
		<?php echo $form->textField($model,'describe_need'); ?>
		<?php echo $form->error($model,'describe_need'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->