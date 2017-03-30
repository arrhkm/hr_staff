<?php
/* @var $this KasbonController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Kasbons',
);

$this->menu=array(
	array('label'=>'Create Kasbon', 'url'=>array('create')),
	array('label'=>'Manage Kasbon', 'url'=>array('admin')),
);
?>

<h1>Kasbons</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
