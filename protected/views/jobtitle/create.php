<?php
/* @var $this JobtitleController */
/* @var $model Jobtitle */

$this->breadcrumbs=array(
	'Jobtitles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Jobtitle', 'url'=>array('index')),
	array('label'=>'Manage Jobtitle', 'url'=>array('admin')),
);
?>

<h1>Create Jobtitle</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>