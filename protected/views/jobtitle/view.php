<?php
/* @var $this JobtitleController */
/* @var $model Jobtitle */

$this->breadcrumbs=array(
	'Jobtitles'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Jobtitle', 'url'=>array('index')),
	array('label'=>'Create Jobtitle', 'url'=>array('create')),
	array('label'=>'Update Jobtitle', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Jobtitle', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Jobtitle', 'url'=>array('admin')),
);
?>

<h1>View Jobtitle #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'level',
	),
)); ?>
