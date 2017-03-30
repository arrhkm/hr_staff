<?php
/* @var $this PermitcodeController */
/* @var $model Permitcode */

$this->breadcrumbs=array(
	'Permitcodes'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Permitcode', 'url'=>array('index')),
	array('label'=>'Create Permitcode', 'url'=>array('create')),
	array('label'=>'Update Permitcode', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Permitcode', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Permitcode', 'url'=>array('admin')),
);
?>

<h1>View Permitcode #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
