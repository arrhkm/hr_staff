<?php
/* @var $this KasbonController */
/* @var $data Kasbon */
?>

<div class="view">

	

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kasbon_date')); ?>:</b>
	<?php echo CHtml::encode($data->kasbon_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kasbon_value')); ?>:</b>
	<?php echo CHtml::encode($data->kasbon_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kasbon_closing')); ?>:</b>
	<?php echo CHtml::encode($data->kasbon_closing); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emp_id')); ?>:</b>
	<?php echo CHtml::encode($data->emp_id); ?>
	<br />


</div>