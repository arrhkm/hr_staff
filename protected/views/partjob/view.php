<?php
/* @var $this PartjobController */
/* @var $model Partjob */

$this->breadcrumbs=array(
	'Partjobs'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Partjob', 'url'=>array('index')),
	array('label'=>'Create Partjob', 'url'=>array('create')),
	array('label'=>'Update Partjob', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Partjob', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Partjob', 'url'=>array('admin')),
);
?>

<h1>View Partjob #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'departement_id',
		'name',
	),
)); ?>
