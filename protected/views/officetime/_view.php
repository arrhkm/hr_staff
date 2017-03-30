<?php
/* @var $this OfficetimeController */
/* @var $data Officetime */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_time')); ?>:</b>
	<?php echo CHtml::encode($data->name_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('must_in')); ?>:</b>
	<?php echo CHtml::encode($data->must_in); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('must_out')); ?>:</b>
	<?php echo CHtml::encode($data->must_out); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('limit_in_start')); ?>:</b>
	<?php echo CHtml::encode($data->limit_in_start); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('limit_in_last')); ?>:</b>
	<?php echo CHtml::encode($data->limit_in_last); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('limit_out_start')); ?>:</b>
	<?php echo CHtml::encode($data->limit_out_start); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('limit_out_last')); ?>:</b>
	<?php echo CHtml::encode($data->limit_out_last); ?>
	<br />

	*/ ?>

</div>