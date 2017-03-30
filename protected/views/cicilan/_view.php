<?php
/* @var $this CicilanController */
/* @var $data Cicilan */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_angsuran')); ?>:</b>
	<?php echo CHtml::encode($data->no_angsuran); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_cicil')); ?>:</b>
	<?php echo CHtml::encode($data->date_cicil); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('value_cicil')); ?>:</b>
	<?php echo CHtml::encode($data->value_cicil); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kasbon_id')); ?>:</b>
	<?php echo CHtml::encode($data->kasbon_id); ?>
	<br />


</div>