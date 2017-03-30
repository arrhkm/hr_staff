<?php
/* @var $this CicilanController */
/* @var $model Cicilan */

$this->breadcrumbs=array(
	'Cicilans'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List Cicilan', 'url'=>array('index')),
	array('label'=>'Create Cicilan', 'url'=>array('create')),
	//array('label'=>'Update Cicilan', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Cicilan', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Cicilan', 'url'=>array('admin')),
);
?>

<h1>View Cicilan #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'no_angsuran',
		'date_cicil',
		//'value_cicil',
		array(			
			'name'=>'Value Cicilan',           
			'value'=>CHtml::encode(yii::app()->hakamFormat->formatNumber($model->value_cicil)),
		),
		'kasbon_id',
	),
)); ?>
