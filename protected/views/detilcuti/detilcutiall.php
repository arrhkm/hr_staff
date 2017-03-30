<?php
/* @var $this DetilcutiController */
/* @var $model Detilcuti */

$this->breadcrumbs=array(
	'Detilcutis'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Detilcuti', 'url'=>array('index')),
	//array('label'=>'Create Detilcuti', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#detilcuti-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Detilcutis</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array(
	//'model'=>$model,
//)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detilcuti-grid',
	'dataProvider'=>$model->detil($id),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'cuti_id',
		'cuti_emp_id',
		'kodecuti_id',
		'date_cuti',
		'emp_name',
		'cuti_name',
		//array('header'=>'emp name', 'value'=>'"$data->emp_name"'),
		//array('header'=>'cuti name', 'value'=>'$data[cuti_name]'),
		//array(
		//	'class'=>'CButtonColumn',
		//),
	),
)); ?>
