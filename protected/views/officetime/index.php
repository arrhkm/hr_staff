<?php
/* @var $this OfficetimeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Officetimes',
);

$this->menu=array(
	array('label'=>'Create Officetime', 'url'=>array('create')),
	array('label'=>'Manage Officetime', 'url'=>array('admin')),
);
?>

<h1>Officetimes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
