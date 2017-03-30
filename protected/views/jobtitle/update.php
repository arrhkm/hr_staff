<?php
/* @var $this JobtitleController */
/* @var $model Jobtitle */

$this->breadcrumbs=array(
	'Jobtitles'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Jobtitle', 'url'=>array('index')),
	array('label'=>'Create Jobtitle', 'url'=>array('create')),
	array('label'=>'View Jobtitle', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Jobtitle', 'url'=>array('admin')),
);
?>

<h1>Update Jobtitle <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>