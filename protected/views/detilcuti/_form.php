<?php
/* @var $this DetilcutiController */
/* @var $model Detilcuti */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'detilcuti-form',
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
		<?php echo $form->labelEx($model,'cuti_id'); ?>
		<?php echo $form->textField($model,'cuti_id', array('value'=>$_REQUEST[detilcuti_id], 'readOnly'=>true)); ?>
		<?php echo $form->error($model,'cuti_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cuti_emp_id'); ?>
		<?php //echo $form->textField($model,'cuti_emp_id',array('size'=>15,'maxlength'=>15)); ?>
		<?php 
			//$model_cuti= cuti::model()->findByPk($_GET[detilcuti_id]);
			//$list= CHtml::listData(Emp::model()->findAll(), 'id', 'name');
			//echo $form->dropDownList($model, 'cuti_emp_id', $list);
			echo $form->textField($model,'cuti_emp_id',array('size'=>15,'maxlength'=>15, 'value'=>$_GET['emp_id'], 'readOnly'=>true)); 
		?>
		<?php echo $form->error($model,'cuti_emp_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kodecuti_id'); ?>
		<?php 
			//echo $form->textField($model,'kodecuti_id'); 
			$list= CHtml::listData(Kodecuti::model()->findAll(), 'id', 'name');
			echo $form->dropDownList($model, 'kodecuti_id', $list);
		?>
		<?php echo $form->error($model,'kodecuti_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'date_cuti'); ?>
		<?php 
		/*			
			$this->widget('zii.widgets.jui.CJuiDatePicker', 
				array(
					'name'=>'date_cuti',
					'model'=>$model,
					'attribute'=>'date_cuti',
					'value'=>date('Y-m-d'),
					'options'=>array(
						'dateFormat'=>'yy-mm-dd',
						'showAnim'=>'slide',						
					),
				)

			);
			*/
		?>
		<?php //echo $form->error($model,'date_cuti'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dateStart'); ?>
		<?php 			
			$this->widget('zii.widgets.jui.CJuiDatePicker', 
				array(
					'name'=>'dateStart',
					'model'=>$model,
					'attribute'=>'dateStart',
					'value'=>date('Y-m-d'),
					'options'=>array(
						'dateFormat'=>'yy-mm-dd',
						'showAnim'=>'slide',						
					),
				)

			);
		?>
		<?php echo $form->error($model,'dateStart'); ?>
	</div>

		<div class="row">
		<?php echo $form->labelEx($model,'dateEnd'); ?>
		<?php 			
			$this->widget('zii.widgets.jui.CJuiDatePicker', 
				array(
					'name'=>'dateEnd',
					'model'=>$model,
					'attribute'=>'dateEnd',
					'value'=>date('Y-m-d'),
					'options'=>array(
						'dateFormat'=>'yy-mm-dd',
						'showAnim'=>'slide',						
					),
				)

			);
		?>
		<?php echo $form->error($model,'dateEnd'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php 
	/*foreach($dtDate as $dtDates)
	{
		echo "<br> ".$dtDates;
	}
*/
	/*foreach ($dtNum as $dtNums)
	{
		echo "<br> num :".$dtNums;
	}*/
?>