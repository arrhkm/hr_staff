<?php
/* @var $this DayoffController */
/* @var $model Dayoff */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'dayoff-form',
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
		<?php //echo $form->textField($model,'id'); ?>
		<?php 
			$this->widget('zii.widgets.jui.CJuiDatePicker', 
				array(
					'name'=>'id',
					'model'=>$model,
					'attribute'=>'id',
					'value'=>date('Y-m-d'),
					'options'=>array(
						'dateFormat'=>'yy-mm-dd',
						'showAnim'=>'slide',						
					),
				)

			);
		?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'period_id'); ?>
		<?php //echo $form->textField($model,'period_id', array('value'=>$_GET[period_id], 'readOnly'=>true)); ?>
		<?php 
			if ($_GET['period_id']){				
				$list= CHtml::listData(Period::model()->findAllByPk($_GET['period_id']), 'id', 'period_name');
			} else {
				$criteria = New CDbCriteria;
				$criteria->order = 'date_end DESC';
				$list= CHtml::listData(Period::model()->findAll($criteria), 'id', 'period_name');
			}
			echo $form->dropDownList($model, 'period_id', $list);
		?>
		<?php echo $form->error($model,'period_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'describe_off'); ?>
		<?php echo $form->textArea($model,'describe_off',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'describe_off'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->