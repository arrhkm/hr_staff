<?php
/* @var $this PermitdetilController */
/* @var $data Permitdetil */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_permit')); ?>:</b>
	<?php echo CHtml::encode($data->date_permit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('permit_id')); ?>:</b>
	<?php echo CHtml::encode($data->permit_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('permit_emp_id')); ?>:</b>
	<?php echo CHtml::encode($data->permit_emp_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('permitcode_id')); ?>:</b>
	<?php echo CHtml::encode($data->permitcode_id); ?>
	<br />


</div>