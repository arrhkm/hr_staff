<?php
/* @var $this KasbonController */
/* @var $model Kasbon */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'kasbon-form',
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
		<?php echo $form->labelEx($model,'kasbon_date'); ?>
		<?php //echo $form->textField($model,'kasbon_date'); ?>
		<?php 
			$this->widget('zii.widgets.jui.CJuiDatePicker', 
				array(
					'name'=>'kasbon_date',
					'attribute'=>'kasbon_date', 
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
		<?php echo $form->error($model,'kasbon_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kasbon_value'); ?>
		<?php echo $form->textField($model,'kasbon_value',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'kasbon_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kasbon_closing'); ?>
		<?php echo $form->textField($model,'kasbon_closing'); ?>
		<?php echo $form->error($model,'kasbon_closing'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'emp_id'); ?>
		<?php //echo $form->textField($model,'emp_id',array('size'=>15,'maxlength'=>15)); ?>
		<?php 
			$crit= new CDbCriteria;
			$crit->order= "name ASC";
			$list=CHtml::listData(Emp::model()->findAll($crit), 'id', 'name');
			echo $form->dropDownList($model, 'emp_id', $list);

		?>
		<?php echo $form->error($model,'emp_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->