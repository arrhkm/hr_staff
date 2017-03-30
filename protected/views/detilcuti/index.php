<?php
/* @var $this DetilcutiController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Detilcutis',
);

$this->menu=array(
	array('label'=>'Create Detilcuti', 'url'=>array('create')),
	array('label'=>'Manage Detilcuti', 'url'=>array('admin')),
);
?>

<h1>Detilcutis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
