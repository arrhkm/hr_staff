<?php
/* @var $this PermitdetilController */
/* @var $model Permitdetil */

$this->breadcrumbs=array(
	'Permitdetils'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Permitdetil', 'url'=>array('index')),
	array('label'=>'Create Permitdetil', 'url'=>array('create')),
	array('label'=>'View Permitdetil', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Permitdetil', 'url'=>array('admin')),
);
?>

<h1>Update Permitdetil <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>