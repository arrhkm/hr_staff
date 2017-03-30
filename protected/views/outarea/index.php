<?php
/* @var $this OutareaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Outareas',
);

$this->menu=array(
	array('label'=>'Create Outarea', 'url'=>array('create')),
	array('label'=>'Manage Outarea', 'url'=>array('admin')),
);
?>

<h1>Outareas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
