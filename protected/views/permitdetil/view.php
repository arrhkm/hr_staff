<?php
/* @var $this PermitdetilController */
/* @var $model Permitdetil */

$this->breadcrumbs=array(
	'Permitdetils'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Permitdetil', 'url'=>array('index')),
	array('label'=>'Create Permitdetil', 'url'=>array('create')),
	array('label'=>'Update Permitdetil', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Permitdetil', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Permitdetil', 'url'=>array('admin')),
);
?>

<h1>View Permitdetil #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'date_permit',
		'permit_id',
		'permit_emp_id',
		'permitcode_id',
	),
)); ?>
