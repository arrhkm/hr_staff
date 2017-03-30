<?php
/* @var $this DayoffController */
/* @var $model Dayoff */

$this->breadcrumbs=array(
	'Dayoffs'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Dayoff', 'url'=>array('index')),
	array('label'=>'Create Dayoff', 'url'=>array('create')),
	array('label'=>'View Dayoff', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Dayoff', 'url'=>array('admin')),
);
?>

<h1>Update Dayoff <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>