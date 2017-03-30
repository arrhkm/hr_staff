<?php
/* @var $this DayoffController */
/* @var $model Dayoff */

$this->breadcrumbs=array(
	'Dayoffs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Dayoff', 'url'=>array('index')),
	array('label'=>'Manage Dayoff', 'url'=>array('admin')),
);
?>

<h1>Create Dayoff</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>