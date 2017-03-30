<?php
/* @var $this CutiController */
/* @var $model Cuti */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'serviceout-form',
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
			$criteria = New CDbCriteria;
			$criteria->alias = 'a';
			$criteria->select= "a.id, a.name";
			$criteria->join= 'JOIN serviceout b ON a.id != b.emp_id';
			$criteria->order='a.name';

			$list= CHtml::listData(Emp::model()->findAll($criteria), 'id', 'name', 'id');
			echo $form->dropDownList($model, 'emp_id', $list, array('empty'=>'-- none --'));
		?>
		<?php echo $form->error($model,'emp_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'note'); ?>
		<?php echo $form->textField($model,'note'); ?>
		<?php echo $form->error($model,'note'); ?>
	</div>	

	<div class="row">
		<?php //echo $form->labelEx($model,'date_cuti'); ?>
		<?php //echo $form->textField($model,'date_cuti'); ?>
		<?php 
			/*$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'name'=>'date_cuti', 
				'model'=>$model, 'attribute'=>'date_cuti','value'=>date('Y-m-d'), 
				'options'=>array('showAnim'=>'slide', 'showButtonPanel'=>true, 'dateFormat'=>'yy-mm-dd'),
			));
			*/

		?>
		<?php //echo $form->error($model,'date_cuti'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php /*
echo "id  :".$model->id;
echo "<br>emp id : ". $model->emp_id;
echo "<br>note : ".$model->note;
if ($model_emp){
	echo "<br>name : ".$model_emp;
}
*/

?>