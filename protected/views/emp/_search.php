<?php
/* @var $this EmpController */
/* @var $model Emp */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gender'); ?>
		<?php echo $form->textField($model,'gender',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'start_job'); ?>
		<?php echo $form->textField($model,'start_job'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'warm_contract'); ?>
		<?php echo $form->textField($model,'warm_contract'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'warm_date'); ?>
		<?php echo $form->textField($model,'warm_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'citizen_id'); ?>
		<?php echo $form->textField($model,'citizen_id',array('size'=>19,'maxlength'=>19)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jamsostek_id'); ?>
		<?php echo $form->textField($model,'jamsostek_id',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bank_account'); ?>
		<?php echo $form->textField($model,'bank_account',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'npwp'); ?>
		<?php echo $form->textField($model,'npwp',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gp'); ?>
		<?php echo $form->textField($model,'gp',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tmasakerja'); ?>
		<?php echo $form->textField($model,'tmasakerja',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tjabatan'); ?>
		<?php echo $form->textField($model,'tjabatan',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tfunctional'); ?>
		<?php echo $form->textField($model,'tfunctional',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'allowance'); ?>
		<?php echo $form->textField($model,'allowance',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'premi_hadir'); ?>
		<?php echo $form->textField($model,'premi_hadir',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'partjob_id'); ?>
		<?php echo $form->textField($model,'partjob_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jobtitle_id'); ?>
		<?php echo $form->textField($model,'jobtitle_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'officetime_id'); ?>
		<?php echo $form->textField($model,'officetime_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->