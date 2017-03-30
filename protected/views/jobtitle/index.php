<?php
/* @var $this JobtitleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Jobtitles',
);

$this->menu=array(
	array('label'=>'Create Jobtitle', 'url'=>array('create')),
	array('label'=>'Manage Jobtitle', 'url'=>array('admin')),
);
?>

<h1>Jobtitles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
