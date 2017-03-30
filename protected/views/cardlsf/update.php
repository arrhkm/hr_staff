<?php
/* @var $this CardlsfController */
/* @var $model Cardlsf */

$this->breadcrumbs=array(
	'Cardlsfs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Cardlsf', 'url'=>array('index')),
	array('label'=>'Create Cardlsf', 'url'=>array('create')),
	//array('label'=>'View Cardlsf', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Cardlsf', 'url'=>array('admin')),
);
?>

<h1>Update Cardlsf <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>