<?php
/* @var $this OutareaHasEmpController */
/* @var $model OutareaHasEmp */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'outarea-has-emp-tambah-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>	

	<div class="row">
		<?php echo $form->labelEx($model,'emp_id'); ?>
		<?php //echo $form->textField($model,'emp_id'); ?>
		<?php 
			echo $form->dropDownList($model, 'emp_id', CHtml::listData(Emp::model()->findAll(array('order'=>'name ASC')), 'id', 'name'), array('empty'=>'--none--')); 
		?>
		<?php echo $form->error($model,'emp_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_start'); ?>
		<?php //echo $form->textField($model,'date_start'); ?>
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
		<?php //echo $form->textField($model,'date_end'); ?>
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
		<?php echo $form->labelEx($model,'desout'); ?>
		<?php echo $form->textField($model,'desout'); ?>
		<?php echo $form->error($model,'desout'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php 

echo "Selisih :". $selisih;
echo "<br> Emp :". $model->emp_id;
echo "<br> Describe :". $model->desout;
if ($dtDate)
{
	foreach ($dtDate as $dtDates){
		echo "<br>". $dtDates;
	}
}

?>