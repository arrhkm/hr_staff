<?php
/* @var $this DetilcutiController */
/* @var $model Detilcuti */

$this->breadcrumbs=array(
	'Detilcutis'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Detilcuti', 'url'=>array('index')),
	array('label'=>'Create Detilcuti', 'url'=>array('create')),
	array('label'=>'View Detilcuti', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Detilcuti', 'url'=>array('admin')),
);
?>

<h1>Update Detilcuti <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>