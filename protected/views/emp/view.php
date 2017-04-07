<?php
/* @var $this EmpController */
/* @var $model Emp */

$this->breadcrumbs=array(
	'Emps'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Emp', 'url'=>array('index')),
	array('label'=>'Create Emp', 'url'=>array('create')),
	array('label'=>'Update Emp', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Emp', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Emp', 'url'=>array('admin')),
);
?>

<h1>View Emp #<?php echo $model->id; ?></h1>

    
<?php 
if (Yii::app()->user->level==9){
//$this->widget('zii.widgets.CDetailView', array(
$this->widget('booster.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'gender',
		'start_job',
		'warm_contract',
		'warm_date',
		'citizen_id',
		'jamsostek_id',
		'bank_account',
		'npwp',
		//'gp',
		array(
			'name'=>'Gaji Pokok',           
			'value'=>CHtml::encode(Convert::NumberToMoney($model->gp)),
		),
		array(
			'name'=>'Tunjangan Masa kerja',           
			'value'=>CHtml::encode(yii::app()->hakamFormat->formatNumber($model->tmasakerja)),
		),
		array(
			'name'=>'tjabatan',           
			'value'=>CHtml::encode(yii::app()->hakamFormat->formatNumber($model->tjabatan)),
		),
		array(
			'name'=>'tfunctional',           
			'value'=>CHtml::encode(yii::app()->hakamFormat->formatNumber($model->tfunctional)),
		),
		array(
			'name'=>'allowance',           
			'value'=>CHtml::encode(yii::app()->hakamFormat->formatNumber($model->allowance)),
		),
		array(
			'name'=>'premi_hadir',           
			'value'=>CHtml::encode(yii::app()->hakamFormat->formatNumber($model->premi_hadir)),
		),
		array(
			'name'=>'uang_makan',           
			'value'=>CHtml::encode(Convert::NumberToMoney($model->uang_makan)),
		),
		/*'tmasakerja',
		'tjabatan',
		'tfunctional',
		'allowance',
		'premi_hadir',*/
		'dapen',
		'stock_cuti',
		'email',
		'partjob_id',
		'jobtitle_id',
		'officetime_id',
		'non_aktif',
	),
)); 
} else { 
//$this->widget('zii.widgets.CDetailView', array(
$this->widget('booster.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'gender',
		'start_job',
		'warm_contract',
		'warm_date',
		'citizen_id',
		'jamsostek_id',
		'bank_account',
		'npwp',
		//'gp',
		/*'tmasakerja',
		'tjabatan',
		'tfunctional',
		'allowance',
		'premi_hadir',
		'dapen',
		
		array(
			'name'=>'Tunjangan Masa kerja',           
			'value'=>CHtml::encode(yii::app()->hakamFormat->formatNumber($model->tmasakerja)),
		),
		array(
			'name'=>'tjabatan',           
			'value'=>CHtml::encode(yii::app()->hakamFormat->formatNumber($model->tjabatan)),
		),
		array(
			'name'=>'tfunctional',           
			'value'=>CHtml::encode(yii::app()->hakamFormat->formatNumber($model->tfunctional)),
		),
		array(
			'name'=>'allowance',           
			'value'=>CHtml::encode(yii::app()->hakamFormat->formatNumber($model->allowance)),
		),
		array(
			'name'=>'premi_hadir',           
			'value'=>CHtml::encode(yii::app()->hakamFormat->formatNumber($model->premi_hadir)),
		),
		array(
			'name'=>'dapen',           
			'value'=>CHtml::encode(yii::app()->hakamFormat->formatNumber($model->dapen)),
		),
		*/
		'stock_cuti',
		'email',
		'partjob_id',
		'jobtitle_id',
		'officetime_id',
		'non_aktif',
		'branch_id',
	),
)); 
}

?>
