<?php
/* @var $this SuratdokterController */
/* @var $model Suratdokter */

$this->breadcrumbs=array(
	'Suratdokters'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Suratdokter', 'url'=>array('index')),
	array('label'=>'Create Suratdokter', 'url'=>array('create')),
	array('label'=>'View Suratdokter', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Suratdokter', 'url'=>array('admin')),
);
?>

<h1>Update Suratdokter <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>