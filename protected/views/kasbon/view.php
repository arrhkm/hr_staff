<?php
/* @var $this KasbonController */
/* @var $model Kasbon */

$this->breadcrumbs=array(
	'Kasbons'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Kasbon', 'url'=>array('index')),
	array('label'=>'Create Kasbon', 'url'=>array('create')),
	array('label'=>'Update Kasbon', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Kasbon', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Kasbon', 'url'=>array('admin')),
	array('label'=>'Bayar Cicilan Kasbon', 'url'=>array('/cicilan/create', 'kasbon_id'=>$model->id)),
);
?>

<h1>View Kasbon #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'kasbon_date',
		//'kasbon_value',
		array(			
			'name'=>'Kasbon',           
			'value'=>CHtml::encode(yii::app()->hakamFormat->formatNumber($model->kasbon_value)),
		),
		'kasbon_closing',
		'emp_id',
		'emp.name',
	),
)); 


//$mCicilan= Cicilan::model()->findByAttributes(array('kasbon_id'=>$model->id));
/*
$critCicil= new CDbCriteria;
$critCicil->condition= 'kasbon_id=:kasbon_id';
$critCicil->params = array(':kasbon_id'=>$model->id);

$mCicilan = New CActiveDataProvider('Cicilan', array(
			'criteria'=>$critCicil,
		));
*/
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cicilan-grid',
	'dataProvider'=>$mCicilan,
	//'filter'=>$model,
	'columns'=>array(
		'id',
		'no_angsuran',
		'date_cicil',
		//'value_cicil',
		array('name'=>'Nilai Cicilan', 'value'=>'yii::app()->hakamFormat->formatNumber($data->value_cicil)'),
		'kasbon_id',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}',
			'buttons'=>array(
				'delete'=>array('url'=>'$this->grid->controller->createUrl("kasbon/deleteCicilan",array("id"=>$data["id"], "kasbon_id"=>$data["kasbon_id"]))'),
			),
		),
	),
)); 
/*
$sqlcount= "SELECT SUM(value_cicil) FROM cicilan WHERE kasbon_id = $model->id";
$sumCicilan= yii::app()->db->createCommand($sqlcount)->queryScalar();
$saldo = $model->kasbon_value-$sumCicilan;
*/
echo " Kasbon : ".yii::app()->hakamFormat->formatNumber($model->kasbon_value). 
	"<br> Total angsuran : ".yii::app()->hakamFormat->formatNumber($sumCicilan). 
	"<br> Sisa Kasbon : ".yii::app()->hakamFormat->formatNumber($saldo);

?>
