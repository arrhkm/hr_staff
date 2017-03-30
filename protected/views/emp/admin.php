<?php
/* @var $this EmpController */
/* @var $model Emp */

$this->breadcrumbs=array(
	'Emps'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Emp', 'url'=>array('index')),
	array('label'=>'Create Emp', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#emp-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Emps</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
if (Yii::app()->user->level==9)
{
	//$this->widget('zii.widgets.grid.CGridView', array(
	$this->widget('booster.widgets.TbGridView',   array(
   
		'id'=>'emp-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		//'type'=>'striped bordered condensed',
		'columns'=>array(
			'id',
			'name',
			//'gender',
			//'email',
			'start_job',
			
			//'warm_date',
			
			//'premi_hadir',
			//'warm_contract',
			
			
			//'citizen_id',
			//'jamsostek_id',
			array('header'=>'Rekening', 'name'=>'bank_account', 'value'=>'$data->bank_account'),
			//'npwp',		
			
			
		/*
			array('name'=>'gp', 'value'=>'Convert::numberToMoney($data->gp)'),
			array('name'=>'tmasakerja', 'value'=>'Convert::numberToMoney($data->tmasakerja)'),
			array('name'=>'tjabatan', 'value'=>'Convert::numberToMoney($data->tjabatan)'),
			array('name'=>'tfunctional', 'value'=>'Convert::numberToMoney($data->tfunctional)'),
			array('name'=>'allowance', 'value'=>'Convert::numberToMoney($data->allowance)'),
			array('name'=>'premi_hadir', 'value'=>'Convert::numberToMoney($data->premi_hadir)'),
			array('name'=>'dapen', 'value'=>'Convert::numberToMoney($data->dapen)'),
			array('name'=>'uang_makan', 'value'=>'Convert::numberToMoney($data->uang_makan)'),
		*/
			'email',
			//'partjob_id',
			//'jobtitle_id',
			'officetime_id',
			'branch_id',
			
			array(
				//'class'=>'CButtonColumn',
				//'header'=>'Action',
				'class'=>'booster.widgets.TbButtonColumn',				
				'htmlOptions' => array('nowrap'=>'nowrap'),

			),
		),
	)); 
}else {
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'emp-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			'id',
			'name',
			'gender',
			'email',
			'start_job',
			'warm_date',						
			'warm_contract',			
			'citizen_id',
			'jamsostek_id',
			'bank_account',
			'npwp',			
			//'gp',			
			//'tmasakerja',
			//'tjabatan',
			//'tfunctional',
			//'allowance',
			//'premi_hadir',
			'email',
			'partjob_id',
			'jobtitle_id',
			'officetime_id',
			'branch_id',
			
			array(
				//'class'=>'CButtonColumn',
				'class'=>'booster.widgets.TbButtonColumn',
				'htmlOptions' => array('nowrap'=>'nowrap'),
			),

		),
	)); 
}

?>
