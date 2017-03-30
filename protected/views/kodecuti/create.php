<?php
/* @var $this KodecutiController */
/* @var $model Kodecuti */

$this->breadcrumbs=array(
	'Kodecutis'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Kodecuti', 'url'=>array('index')),
	array('label'=>'Manage Kodecuti', 'url'=>array('admin')),
);
?>

<h1>Create Kodecuti</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>