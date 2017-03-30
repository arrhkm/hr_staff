<?php
/* @var $this PeriodController */
/* @var $model Period */

$this->breadcrumbs=array(
	'Periods'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Period', 'url'=>array('index')),
	array('label'=>'Create Period', 'url'=>array('create')),
	
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#period-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Periods</h1>

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

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'period-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			//'id'=>,
			'name'=>'id',
		    //'value'=>'id',
		    'htmlOptions'=>array('width'=>'5%'),
		),
		array(
			'name'=>'date_start',
			'htmlOptions'=>array('width'=>'15%')
		),
		array('name'=>'date_end', 'htmlOptions'=>array('width'=>'15%')),
		array('name'=>'period_name', 'htmlOptions'=>array('width'=>'20%')),
		array(
			'class'=>'CButtonColumn',
			'template' => '{view}{update}{delete}{payroll}',
            'buttons' => array(
                //'dayoff' => array('url' => '$this->grid->controller->createUrl("dayoff/create",array("period_id"=>$data["id"]))'),               
            	'payroll'=> array('url' => '$this->grid->controller->createUrl("period/payroll",array("period_id"=>$data["id"]))'),
            ),
		),
	),
)); ?>
