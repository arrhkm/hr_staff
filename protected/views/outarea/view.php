<?php
/* @var $this OutareaController */
/* @var $model Outarea */

$this->breadcrumbs=array(
	'Outareas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Outarea', 'url'=>array('index')),
	array('label'=>'Create Outarea', 'url'=>array('create')),
	array('label'=>'Update Outarea', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Outarea', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Outarea', 'url'=>array('admin')),
	array('label'=>'Tambah employee', 'url'=>array('empdinas', 'id'=>$model->id)),
);
?>

<h1>View Outarea #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'keperluan',
		'datestart',
		'dateend',
		//'datearray',
	),
)); 

$tgl= explode(',', $model->datearray);
foreach ($tgl as $tgls){
	echo "<br>".$tgls;
}
?>

