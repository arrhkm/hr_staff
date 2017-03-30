<?php
/* @var $this PartjobController */
/* @var $model Partjob */

$this->breadcrumbs=array(
	'Partjobs'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Partjob', 'url'=>array('index')),
	array('label'=>'Create Partjob', 'url'=>array('create')),
	array('label'=>'View Partjob', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Partjob', 'url'=>array('admin')),
);
?>

<h1>Update Partjob <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>