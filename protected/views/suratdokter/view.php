<?php
/* @var $this SuratdokterController */
/* @var $model Suratdokter */

$this->breadcrumbs=array(
	'Suratdokters'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Suratdokter', 'url'=>array('index')),
	array('label'=>'Create Suratdokter', 'url'=>array('create')),
	array('label'=>'Update Suratdokter', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Suratdokter', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Suratdokter', 'url'=>array('admin')),
);
?>

<h1>View Suratdokter #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'date_sick',
		'no_surat',
		'dokter_name',
		'emp_id',
	),
)); ?>
