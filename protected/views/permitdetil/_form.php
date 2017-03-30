<?php
/* @var $this PermitdetilController */
/* @var $model Permitdetil */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'permitdetil-form',
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
		<?php echo $form->hiddenField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_permit'); ?>
		<?php //echo $form->textField($model,'date_permit'); ?>
		<?php 			
			$this->widget('zii.widgets.jui.CJuiDatePicker', 
				array(
					'name'=>'date_permit',
					'model'=>$model,
					'attribute'=>'date_permit',
					'value'=>date('Y-m-d'),
					'options'=>array(
						'dateFormat'=>'yy-mm-dd',
						'showAnim'=>'slide',						
					),
				)

			);
		?>
		<?php echo $form->error($model,'date_permit'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'permit_id'); ?>
		<?php echo $form->hiddenField($model,'permit_id', array('value'=>$_GET[permit_id], 'readOnly'=>true)); ?>
		<?php echo $form->error($model,'permit_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'permit_emp_id'); ?>
		<?php echo $form->hiddenField($model,'permit_emp_id',array('size'=>15,'maxlength'=>15, 'value'=>$_GET[permit_emp_id], 'readOnly'=>true)); ?>
		<?php echo $form->error($model,'permit_emp_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'permitcode_id'); ?>
		<?php //echo $form->textField($model,'permitcode_id',array('size'=>5,'maxlength'=>5)); ?>
		<?php 
			$list= CHtml::listData(Permitcode::model()->findAll(), 'id', 'name');
			echo $form->dropDownList($model, 'permitcode_id', $list, array('empty'=>'-- none --'));
		?>
		<?php echo $form->error($model,'permitcode_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->