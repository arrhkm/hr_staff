<?php
/* @var $this OfficetimeController */
/* @var $model Officetime */

$this->breadcrumbs=array(
	'Officetimes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Officetime', 'url'=>array('index')),
	array('label'=>'Create Officetime', 'url'=>array('create')),
	array('label'=>'Update Officetime', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Officetime', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Officetime', 'url'=>array('admin')),
);
?>

<h1>View Officetime #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name_time',
		'must_in',
		'must_out',
		'limit_in_start',
		'limit_in_last',
		'limit_out_start',
		'limit_out_last',
	),
)); ?>
