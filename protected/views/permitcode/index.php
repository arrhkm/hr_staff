<?php
/* @var $this PermitcodeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Permitcodes',
);

$this->menu=array(
	array('label'=>'Create Permitcode', 'url'=>array('create')),
	array('label'=>'Manage Permitcode', 'url'=>array('admin')),
);
?>

<h1>Permitcodes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
