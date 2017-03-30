<?php
/* @var $this PermitcodeController */
/* @var $model Permitcode */

$this->breadcrumbs=array(
	'Permitcodes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Permitcode', 'url'=>array('index')),
	array('label'=>'Manage Permitcode', 'url'=>array('admin')),
);
?>

<h1>Create Permitcode</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>