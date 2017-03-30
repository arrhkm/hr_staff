<?php
/* @var $this PartjobController */
/* @var $model Partjob */

$this->breadcrumbs=array(
	'Partjobs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Partjob', 'url'=>array('index')),
	array('label'=>'Manage Partjob', 'url'=>array('admin')),
);
?>

<h1>Create Partjob</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>