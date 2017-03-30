<?php
/* @var $this KodecutiController */
/* @var $model Kodecuti */

$this->breadcrumbs=array(
	'Kodecutis'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Kodecuti', 'url'=>array('index')),
	array('label'=>'Create Kodecuti', 'url'=>array('create')),
	array('label'=>'View Kodecuti', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Kodecuti', 'url'=>array('admin')),
);
?>

<h1>Update Kodecuti <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>