<?php
/* @var $this PeriodController */
/* @var $model Period */

$this->breadcrumbs=array(
	'Periods'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Period', 'url'=>array('index')),
	array('label'=>'Manage Period', 'url'=>array('admin')),
	array('label'=>'Create Period', 'url'=>array('create')),
	array('label'=>'View Period', 'url'=>array('view', 'id'=>$model->id)),
	
);
?>

<h1>Update Period <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>