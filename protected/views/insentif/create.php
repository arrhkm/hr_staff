<?php
/* @var $this InsentifController */
/* @var $model Insentif */

$this->breadcrumbs=array(
	'Insentifs'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Insentif', 'url'=>array('index')),
	array('label'=>'Manage Insentif', 'url'=>array('admin')),
);
?>

<h1>Create Insentif</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>