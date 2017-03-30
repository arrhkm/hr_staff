<?php
/* @var $this DetilcutiController */
/* @var $model Detilcuti */

$this->breadcrumbs=array(
	'Detilcutis'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Detilcuti', 'url'=>array('index')),
	array('label'=>'Create Detilcuti', 'url'=>array('create')),
	array('label'=>'Update Detilcuti', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Detilcuti', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Detilcuti', 'url'=>array('admin')),
);
?>

<h1>View Detilcuti #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cuti_id',
		'cuti_emp_id',
		'kodecuti_id',
		'date_cuti',
	),
)); ?>
