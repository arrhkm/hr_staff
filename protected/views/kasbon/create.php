<?php
/* @var $this KasbonController */
/* @var $model Kasbon */

$this->breadcrumbs=array(
	'Kasbons'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Kasbon', 'url'=>array('index')),
	array('label'=>'Manage Kasbon', 'url'=>array('admin')),
);
?>

<h1>Create Kasbon</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>