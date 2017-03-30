<?php
/* @var $this EmpController */
/* @var $model Emp */

$this->breadcrumbs=array(
	'Home'=>array('index'),
	'Permit List'=>array('Permit'),
);

$this->menu=array(
	array('label'=>'List Permit', 'url'=>array('index')),
	//array('label'=>'Manage Emp', 'url'=>array('admin')),
);
?>

<h1>Create Permit</h1>

<?php $this->renderPartial('_formPermit', array('model'=>$model)); ?>