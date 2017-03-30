<?php
/* @var $this OutareaController */
/* @var $data Outarea */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('keperluan')); ?>:</b>
	<?php echo CHtml::encode($data->keperluan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datestart')); ?>:</b>
	<?php echo CHtml::encode($data->datestart); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateend')); ?>:</b>
	<?php echo CHtml::encode($data->dateend); ?>
	<br />

	<b><?php //echo CHtml::encode($data->getAttributeLabel('datearray')); ?>:</b>
	<?php //echo CHtml::encode($data->datearray, array('rows'=>6, 'cols'=>25)); ?>
	<br />


</div>