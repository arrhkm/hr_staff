<?php
/* @var $this OutareaController */
/* @var $model Outarea */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'outarea-form',
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
		<?php echo $form->labelEx($model,'keperluan'); ?>
		<?php echo $form->textField($model,'keperluan',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'keperluan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datestart'); ?>
		<?php //echo $form->textField($model,'datestart'); ?>
		<?php 
			$this->widget('zii.widgets.jui.CJuiDatePicker', 
				array(
					'name'=>'datestart',
					'attribute'=>'datestart', 
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
		<?php echo $form->error($model,'datestart'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dateend'); ?>
		<?php //echo $form->textField($model,'dateend'); ?>
		<?php 
			$this->widget('zii.widgets.jui.CJuiDatePicker', 
				array(
					'name'=>'dateend',
					'attribute'=>'dateend', 
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
		<?php echo $form->error($model,'dateend'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datearray'); ?>
		<?php echo $form->textArea($model,'datearray',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'datearray'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->