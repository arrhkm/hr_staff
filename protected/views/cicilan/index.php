<?php
/* @var $this CicilanController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cicilans',
);

$this->menu=array(
	array('label'=>'Back to Kasbon', 'url'=>array('Kasbon/view', 'id'=>$_GET[kasbon_id])),
	array('label'=>'Create Cicilan', 'url'=>array('create')),
	//array('label'=>'Manage Cicilan', 'url'=>array('admin')),
);
?>

<h1>Cicilans</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
