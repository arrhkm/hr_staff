<?php
/* @var $this DetilcutiController */
/* @var $data Detilcuti */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cuti_id')); ?>:</b>
	<?php echo CHtml::encode($data->cuti_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cuti_emp_id')); ?>:</b>
	<?php echo CHtml::encode($data->cuti_emp_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kodecuti_id')); ?>:</b>
	<?php echo CHtml::encode($data->kodecuti_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_cuti')); ?>:</b>
	<?php echo CHtml::encode($data->date_cuti); ?>
	<br />


</div>