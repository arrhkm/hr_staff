<?php
/* @var $this PartjobController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Partjobs',
);

$this->menu=array(
	array('label'=>'Create Partjob', 'url'=>array('create')),
	array('label'=>'Manage Partjob', 'url'=>array('admin')),
);
?>

<h1>Partjobs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
