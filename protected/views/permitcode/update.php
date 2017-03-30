<?php
/* @var $this PermitcodeController */
/* @var $model Permitcode */

$this->breadcrumbs=array(
	'Permitcodes'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Permitcode', 'url'=>array('index')),
	array('label'=>'Create Permitcode', 'url'=>array('create')),
	array('label'=>'View Permitcode', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Permitcode', 'url'=>array('admin')),
);
?>

<h1>Update Permitcode <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>