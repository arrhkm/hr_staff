<?php
/* @var $this CardlsfController */
/* @var $model Cardlsf */

$this->breadcrumbs=array(
	'Cashreceipt'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Cardlsf', 'url'=>array('index')),
	array('label'=>'Manage Cash Receipt', 'url'=>array('admin')),
);
?>

<h1>Create Cash Receipt</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>