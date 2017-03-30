<?php
/* @var $this CicilanController */
/* @var $model Cicilan */

$this->breadcrumbs=array(
	'Cicilans'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Cicilan', 'url'=>array('index')),
	array('label'=>'Create Cicilan', 'url'=>array('create')),
	array('label'=>'View Cicilan', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Cicilan', 'url'=>array('admin')),
);
?>

<h1>Update Cicilan <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>