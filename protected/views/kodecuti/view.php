<?php
/* @var $this KodecutiController */
/* @var $model Kodecuti */

$this->breadcrumbs=array(
	'Kodecutis'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Kodecuti', 'url'=>array('index')),
	array('label'=>'Create Kodecuti', 'url'=>array('create')),
	array('label'=>'Update Kodecuti', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Kodecuti', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Kodecuti', 'url'=>array('admin')),
);
?>

<h1>View Kodecuti #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'limit_cuti',
	),
)); ?>
