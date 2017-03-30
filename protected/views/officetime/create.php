<?php
/* @var $this OfficetimeController */
/* @var $model Officetime */

$this->breadcrumbs=array(
	'Officetimes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Officetime', 'url'=>array('index')),
	array('label'=>'Manage Officetime', 'url'=>array('admin')),
);
?>

<h1>Create Officetime</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>