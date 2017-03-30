<?php
/* @var $this EmpController */
/* @var $model Emp */

$this->breadcrumbs=array(
	'Emps'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Emp', 'url'=>array('index')),
	array('label'=>'Manage Emp', 'url'=>array('admin')),
);
?>

<h1>Create Emp</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>