<?php
/* @var $this SuratdokterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Suratdokters',
);

$this->menu=array(
	array('label'=>'Create Suratdokter', 'url'=>array('create')),
	array('label'=>'Manage Suratdokter', 'url'=>array('admin')),
);
?>

<h1>Suratdokters</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
