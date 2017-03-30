<?php
/* @var $this CardlsfController */
/* @var $model Cardlsf */

$this->breadcrumbs=array(
	'Cardlsfs'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Cardlsf', 'url'=>array('index')),
	array('label'=>'Manage Cardlsf', 'url'=>array('admin')),
);
?>

<h1>Create Cardlsf</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>