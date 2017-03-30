<?php
/* @var $this EmpController */
/* @var $data Emp */
?>

<div class="view">

	<b><?php //echo CHtml::encode($getAttributeLabel->getData('date_job')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data['date_job']), array('view', 'date_job'=>$data['emp_id'])); ?>
	

	<b><?php //echo CHtml::encode($data->getAttributeLabel('name')); ?>//</b>
	<?php echo CHtml::encode($data['name']); ?>
	

	<b><?php //echo CHtml::encode($data->getAttributeLabel('emp_id')); ?>//</b>
	<?php echo CHtml::encode($data['emp_id']); ?>
	

	<b><?php //echo CHtml::encode($data->getAttributeLabel('dt_in')); ?>//</b>
	<?php echo CHtml::encode($data['dt_in']); ?>


	<b><?php //echo CHtml::encode($data['dt_out']); ?>//</b>
	<?php echo CHtml::encode($data->dt_out); ?>
	

	<b><?php //echo CHtml::encode($data->getAttributeLabel('telat')); ?>//</b>
	<?php echo CHtml::encode($data['telat']); ?>
	

	<b><?php echo $data->name; ?>//</b>
	
	


	

	<?php  ?>

</div>