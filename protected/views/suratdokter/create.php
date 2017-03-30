<?php
/* @var $this SuratdokterController */
/* @var $model Suratdokter */

$this->breadcrumbs=array(
	'Suratdokters'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Suratdokter', 'url'=>array('index')),
	array('label'=>'Manage Suratdokter', 'url'=>array('admin')),
);
?>

<h1>Create Suratdokter</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>