<?php
/* @var $this InsentifController */
/* @var $model Insentif */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'insentif-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'id'); ?>
		<?php //echo $form->textField($model,'id'); ?>
		<?php //echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textField($model,'value',array('size'=>10,'maxlength'=>10, 'class'=>'number')); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>
	<script>
	$('input.number').keyup(function(event) 
	{
	       // skip for arrow keys
	       if(event.which >= 37 && event.which <= 40) return;
	       // format number
	       $(this).val(function(index, value) {
	             return value
	            .replace(/\D/g, '')
	            .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
	            ;
	       });
	});
	</script>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'period_id'); ?>
		<?php //echo $form->textField($model,'period_id'); ?>
		<?php 
			$list= CHtml::listData(Period::model()->findAll(array('order'=>'id DESC')), 'id', 'period_name');
			echo $form->dropDownList($model, 'period_id', $list, array('empty'=>'-- none --'));
		?>
		<?php echo $form->error($model,'period_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'emp_id'); ?>
		<?php //echo $form->textField($model,'emp_id',array('size'=>15,'maxlength'=>15)); ?>
		<?php 
			$list= CHtml::listData(Emp::model()->findAll(array('order'=>'id ASC')), 'id', 'id');
			echo $form->dropDownList($model, 'emp_id', $list, array('empty'=>'-- none --'));
		?>
		<?php echo $form->error($model,'emp_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->