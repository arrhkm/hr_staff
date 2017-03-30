<?php
/* @var $this CicilanController */
/* @var $model Cicilan */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cicilan-form',
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
		<?php //echo $form->labelEx($model,'no_angsuran'); ?>
		<?php //echo $form->textField($model,'no_angsuran'); ?>
		<?php //echo $form->error($model,'no_angsuran'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_cicil'); ?>
		<?php //echo $form->textField($model,'date_cicil'); ?>
		<?php 
			$this->widget('zii.widgets.jui.CJuiDatePicker', 
				array(
					'name'=>'date_cicil',
					'attribute'=>'date_cicil', 
					'model'=>$model,				
					'value'=> date('Y-m-d'), 				
					'options'=>	array(
						'dateFormat'=>'yy-mm-dd', 
						'showButtonPanel'=>true, 
						'showAnim' =>'slide'
					),
				)
			);
		?>
		<?php echo $form->error($model,'date_cicil'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'value_cicil'); ?>
		<?php echo $form->textField($model,'value_cicil',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'value_cicil'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kasbon_id'); ?>
		<?php echo $form->textField($model,'kasbon_id', array('value'=>$_GET[kasbon_id], 'readOnly'=>true)); ?>
		<?php echo $form->error($model,'kasbon_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->