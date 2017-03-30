<?php
/* @var $this CardlsfController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cardlsfs',
);

$this->menu=array(
	array('label'=>'Create Cardlsf', 'url'=>array('create')),
	array('label'=>'Manage Cardlsf', 'url'=>array('admin')),
);
?>

<h1>Cardlsfs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
