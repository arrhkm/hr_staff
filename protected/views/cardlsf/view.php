<?php
/* @var $this CardlsfController */
/* @var $model Cardlsf */

$this->breadcrumbs=array(
	'Cardlsfs'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List Cardlsf', 'url'=>array('index')),
	array('label'=>'Create Cardlsf', 'url'=>array('create')),
	array('label'=>'Update Cardlsf', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Cardlsf', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cardlsf', 'url'=>array('admin')),
);
?>

<h1>View Cardlsf #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'emp_id',
		'date_create',
		'sensorid',
	),
)); ?>
