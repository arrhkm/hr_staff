<?php
/* @var $this PeriodController */
/* @var $model Period */

$this->breadcrumbs=array(
	'Periods'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Period', 'url'=>array('index')),
	array('label'=>'Manage Period', 'url'=>array('admin')),
);
?>

<h1>Create Period</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>