<?php
/* @var $this OfficetimeController */
/* @var $model Officetime */

$this->breadcrumbs=array(
	'Officetimes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Officetime', 'url'=>array('index')),
	array('label'=>'Create Officetime', 'url'=>array('create')),
	array('label'=>'View Officetime', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Officetime', 'url'=>array('admin')),
);
?>

<h1>Update Officetime <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>