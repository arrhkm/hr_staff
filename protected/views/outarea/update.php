<?php
/* @var $this OutareaController */
/* @var $model Outarea */

$this->breadcrumbs=array(
	'Outareas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Outarea', 'url'=>array('index')),
	array('label'=>'Create Outarea', 'url'=>array('create')),
	array('label'=>'View Outarea', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Outarea', 'url'=>array('admin')),
);
?>

<h1>Update Outarea <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>