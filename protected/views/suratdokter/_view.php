<?php
/* @var $this SuratdokterController */
/* @var $data Suratdokter */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_sick')); ?>:</b>
	<?php echo CHtml::encode($data->date_sick); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_surat')); ?>:</b>
	<?php echo CHtml::encode($data->no_surat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dokter_name')); ?>:</b>
	<?php echo CHtml::encode($data->dokter_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emp_id')); ?>:</b>
	<?php echo CHtml::encode($data->emp_id); ?>
	<br />


</div>