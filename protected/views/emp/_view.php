<?php
/* @var $this EmpController */
/* @var $data Emp */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gender')); ?>:</b>
	<?php echo CHtml::encode($data->gender); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_job')); ?>:</b>
	<?php echo CHtml::encode($data->start_job); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('warm_contract')); ?>:</b>
	<?php echo CHtml::encode($data->warm_contract); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('warm_date')); ?>:</b>
	<?php echo CHtml::encode($data->warm_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('citizen_id')); ?>:</b>
	<?php echo CHtml::encode($data->citizen_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch_id')); ?>:</b>
	<?php echo CHtml::encode($data->branch_id); ?>
	<br />
	
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('jamsostek_id')); ?>:</b>
	<?php echo CHtml::encode($data->jamsostek_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bank_account')); ?>:</b>
	<?php echo CHtml::encode($data->bank_account); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('npwp')); ?>:</b>
	<?php echo CHtml::encode($data->npwp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gp')); ?>:</b>
	<?php echo CHtml::encode($data->gp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tmasakerja')); ?>:</b>
	<?php echo CHtml::encode($data->tmasakerja); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tjabatan')); ?>:</b>
	<?php echo CHtml::encode($data->tjabatan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tfunctional')); ?>:</b>
	<?php echo CHtml::encode($data->tfunctional); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('allowance')); ?>:</b>
	<?php echo CHtml::encode($data->allowance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('premi_hadir')); ?>:</b>
	<?php echo CHtml::encode($data->premi_hadir); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('partjob_id')); ?>:</b>
	<?php echo CHtml::encode($data->partjob_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jobtitle_id')); ?>:</b>
	<?php echo CHtml::encode($data->jobtitle_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('officetime_id')); ?>:</b>
	<?php echo CHtml::encode($data->officetime_id); ?>
	<br />

	*/ ?>

</div>