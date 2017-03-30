<?php
/* @var $this OutareaController */
/* @var $model Outarea */

$this->breadcrumbs=array(
	'Outareas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Outarea', 'url'=>array('index')),
	array('label'=>'Manage Outarea', 'url'=>array('admin')),
);
?>

<h1>Create Outarea</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>