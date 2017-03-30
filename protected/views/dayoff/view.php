<?php
/* @var $this DayoffController */
/* @var $model Dayoff */

$this->breadcrumbs=array(
	'Dayoffs'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Dayoff', 'url'=>array('index')),
	array('label'=>'Create Dayoff', 'url'=>array('create')),
	array('label'=>'Update Dayoff', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Dayoff', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Dayoff', 'url'=>array('admin')),
);
?>

<h1>View Dayoff #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'period_id',
		'name',
		'describe_off',
	),
)); ?>
