<?php
/* @var $this InsentifController */
/* @var $model Insentif */

$this->breadcrumbs=array(
	'Insentifs'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Insentif', 'url'=>array('index')),
	array('label'=>'Create Insentif', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#insentif-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Insentifs</h1>

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
/*
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'insentif-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		//'value',
		array('name'=>'value', 'value'=>'Convert::NumberToMoney($data->value)'),
		'description',
		'period_id',
		'emp_id',
		'emp_name',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); */?>

<?php 
$this->widget('booster.widgets.TbExtendedGridView', array(
	'id'=>'dailyreport-grid',
	'type'=>'stripted',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'responsiveTable' => true,
	'columns'=>array(
		array('name'=>'value', 'value'=>'Convert::NumberToMoney($data->value)'),
		'description',
		'period_id',
		'emp_id',
		'emp_name',
		array(
			'class'=>'booster.widgets.TbButtonColumn',
			'htmlOptions'=>array('class'=>'col-sm-2'),
			
			'buttons'=>array(
	            'view' => array(
	                'label'=>'view',
	                'url'=>'Yii::app()->createUrl("/insentif/admin", array("id"=>$data->id))',                  
                    'options'=>array(
			        		'class'=>'btn btn-small btn-info', 
			        		'style'=>'margin:1px; padding:5px',                        	
			        )
	            ),
	            'update' => array(
	                'label'=>'Update',
	                'url'=>'Yii::app()->createUrl("/insentif/update", array("id"=>$data->id))',
                    'options'=>array(
			        		'class'=>'btn btn-small btn-warning',
			        		'style'=>'margin:1px; padding:5px',
			        )
	            ),
	            'delete' =>array(
	            	'url'=>'Yii::app()->createUrl("/insentif/delete", array("id"=>$data->id))',
	            	'options'=>array(
			        		'class'=>'btn btn-small btn-danger',
			        		'style'=>'margin:1px; padding:5px',
			        )
	            )
            ),
            'template'=>'{view}{update}{delete}'
		),
	),
)); ?>
