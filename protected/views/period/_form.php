<?php
/* @var $this PeriodController */
/* @var $model Period */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'period-form',
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
		<?php echo $form->textField($model,'id', array('readOnly'=>true)); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_start'); ?>
		<?php 
			$this->widget('zii.widgets.jui.CJuiDatePicker', 
				array(
					'name'=>'date_start',
					'attribute'=>'date_start', 
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
		<?php echo $form->error($model,'date_start'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_end'); ?>
		<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', 
				array(
					'name'=>'date_end',
					'attribute'=>'date_end', 
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
		<?php echo $form->error($model,'date_end'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'period_name'); ?>
		<?php //echo $form->textField($model,'period_name',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'period_name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->