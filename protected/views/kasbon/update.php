<?php
/* @var $this KasbonController */
/* @var $model Kasbon */

$this->breadcrumbs=array(
	'Kasbons'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Kasbon', 'url'=>array('index')),
	array('label'=>'Create Kasbon', 'url'=>array('create')),
	array('label'=>'View Kasbon', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Kasbon', 'url'=>array('admin')),
);
?>

<h1>Update Kasbon <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>