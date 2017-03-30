<?php
/* @var $this PeriodController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Periods',
);

$this->menu=array(
	array('label'=>'Create Period', 'url'=>array('create')),
	array('label'=>'Manage Period', 'url'=>array('admin')),
);
?>

<h1>Periods</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
