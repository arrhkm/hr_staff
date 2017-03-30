<?php
/* @var $this SuratdokterController */
/* @var $model Suratdokter */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'suratdokter-form',
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
		<?php echo $form->labelEx($model,'date_sick'); ?>
		<?php //echo $form->textField($model,'date_sick'); ?>
		<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'name'=>'date_sick', 
				'model'=>$model, 'attribute'=>'date_sick','value'=>date('Y-m-d'), 
				'options'=>array('showAnim'=>'slide', 'showButtonPanel'=>true, 'dateFormat'=>'yy-mm-dd'),
			));
		?>
		<?php echo $form->error($model,'date_sick'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'no_surat'); ?>
		<?php echo $form->textField($model,'no_surat',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'no_surat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dokter_name'); ?>
		<?php echo $form->textField($model,'dokter_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'dokter_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'emp_id'); ?>
		<?php 
			//echo $form->textField($model,'emp_id',array('size'=>15,'maxlength'=>15)); 
			$crit= new CDbCriteria;
			$crit->order='name';
			$list= CHtml::listData(Emp::model()->findAll($crit), 'id', 'name');
			echo $form->dropDownList($model, 'emp_id', $list, array('empty'=>' -- none --'));
		?>
		<?php echo $form->error($model,'emp_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->