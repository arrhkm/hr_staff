<?php
/* @var $this EmpController */
/* @var $model Emp */

$this->breadcrumbs=array(
	'Cuti'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cuti', 'url'=>array('index')),
	//array('label'=>'Manage Emp', 'url'=>array('admin')),
);
?>

<h1>Create Cuti</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>