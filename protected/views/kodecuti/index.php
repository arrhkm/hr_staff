<?php
/* @var $this KodecutiController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Kodecutis',
);

$this->menu=array(
	array('label'=>'Create Kodecuti', 'url'=>array('create')),
	array('label'=>'Manage Kodecuti', 'url'=>array('admin')),
);
?>

<h1>Kodecutis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
