<?php
/* @var $this EmpController */
/* @var $model Emp */

$this->breadcrumbs=array(
	'Service Out'=>array('emp/serviceout'),
	'Add Service Out Eemployee',
);

$this->menu=array(
	array('label'=>'TEST', 'url'=>array('#')),
	array('label'=>'TEST', 'url'=>array('#')),
);
?>

<h1>Add Service Out</h1>

<?php $this->renderPartial('_serviceout', array('model'=>$model, 'model_emp'=>$model_emp)); ?>