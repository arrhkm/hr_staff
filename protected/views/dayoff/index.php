<?php
/* @var $this DayoffController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Dayoffs',
);

$this->menu=array(
	array('label'=>'Create Dayoff', 'url'=>array('create')),
	array('label'=>'Manage Dayoff', 'url'=>array('admin')),
);
?>

<h1>Dayoffs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
