<?php
/* @var $this CicilanController */
/* @var $model Cicilan */

$this->breadcrumbs=array(
	'Cicilans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Back to Kasbon', 'url'=>array('Kasbon/view', 'id'=>$_GET[kasbon_id])),
	//array('label'=>'List Cicilan', 'url'=>array('index')),
	//array('label'=>'Manage Cicilan', 'url'=>array('admin')),
);
?>

<h1>Create Cicilan</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>