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
		<?php //echo $form->labelEx($model,'outarea_id'); ?>
		<?php //echo $form->textField($model,'outarea_id', array('value'=>$model->outarea_id)); ?>
		<?php //echo $form->error($model,'outarea_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'emp_id'); ?>
		<?php 
			$list= CHtml::listData(Emp::model()->findAll(), 'id', 'name');
			echo $form->dropDownList($model, 'emp_id', $list);
			//echo $form->textField($model,'emp_id'); 
		?>
		<?php echo $form->error($model,'emp_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'dateout'); ?>
		<?php //echo $form->textField($model,'dateout'); ?>
		<?php //cho $form->error($model,'dateout'); ?>
	</div>	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php 
echo "emp_id : ".$model->emp_id."<br>";
echo "outarea_id : ".$model->outarea_id."<br>";


$tgl2= explode(',', $tgl);
echo "Tanggal yang di input : ";
foreach($tgl2 as $tgls){
	echo $tgls." * ";
}
echo "<br>";
$sql= " 
	SELECT a.*, b.name 
	FROM outarea_has_emp a, emp b
	WHERE a.outarea_id= $_GET[id]
	AND b.id= a.emp_id

";
$dtOut= Yii::app()->db->createCommand($sql)->queryAll();
echo "<br> Karyawan yang dinas : <br>";
echo "--------------------------------------------- <br>";
foreach($dtOut as $key=>$dtouts) {
	echo $dtouts[emp_id]." - ".$dtouts[name]." - ".$dtouts[dateout]."<br>";
}

?>