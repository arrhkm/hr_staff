<?php
/* @var $this PermitdetilController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Permitdetils',
);

$this->menu=array(
	array('label'=>'Create Permitdetil', 'url'=>array('create')),
	array('label'=>'Manage Permitdetil', 'url'=>array('admin')),
);
?>

<h1>Permitdetils</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
