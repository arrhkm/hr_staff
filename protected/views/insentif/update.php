<?php
/* @var $this InsentifController */
/* @var $model Insentif */

$this->breadcrumbs=array(
	'Insentifs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Insentif', 'url'=>array('index')),
	array('label'=>'Create Insentif', 'url'=>array('create')),
	array('label'=>'View Insentif', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Insentif', 'url'=>array('admin')),
);
?>

<h1>Update Insentif <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>