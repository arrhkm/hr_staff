<?php
/* @var $this InsentifController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Insentifs',
);

$this->menu=array(
	array('label'=>'Create Insentif', 'url'=>array('create')),
	array('label'=>'Manage Insentif', 'url'=>array('admin')),
);
?>

<h1>Insentifs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
