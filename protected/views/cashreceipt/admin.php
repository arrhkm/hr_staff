<?php
/* @var $this CashreceiptController*/
/* @var $model Cashreceipt */

$this->breadcrumbs=array(
	'Cashreceipt'=>array('manage'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Cardlsf', 'url'=>array('index')),
	array('label'=>'Create Cash Receipt', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cardlsf-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Cash Receipt</h1>

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
/*$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cardlsf-grid',
	'dataProvider'=>$model->search2(),
	'filter'=>$model,
	'columns'=>array(
		'emp_id',
		'period_id',
		'period_name',
		'value',		
		'name',		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); */?>

<?php 
$this->widget('booster.widgets.TbExtendedGridView', array(
	'id'=>'dailyreport-grid',
	'type'=>'stripted',
	'dataProvider'=>$model->search2(),
	'filter'=>$model,
	'responsiveTable' => true,
	'columns'=>array(
		'emp_id',
		'period_id',
		'period_name',
		//'value',	
		'name',	
		array('header'=>'Value CR', 'name'=>'value', 'value'=>'Convert::NumberToMoney($data->value)'),
		array(
			'class'=>'booster.widgets.TbButtonColumn',
			'htmlOptions'=>array('class'=>'col-sm-2'),
			'buttons'=>array(
	            /*'view' => array(
	                'label'=>'view',
	                'url'=>'Yii::app()->createUrl("/dailyreport/viewstaff", array("id"=>$data->id))',                  
                    'options'=>array(
			        		'class'=>'btn btn-small btn-info', 
			        		'style'=>'margin:1px; padding:5px',                        	
			        )
	            ),*/
	            'update' => array(
	                'label'=>'Update',
	                'url'=>'Yii::app()->createUrl("/cashreceipt/update", array("id1"=>$data->emp_id, "id2"=>$data->period_id))',
                    'options'=>array(
			        		'class'=>'btn btn-small btn-warning',
			        		'style'=>'margin:1px; padding:5px',
			        )
	            ),
	            'delete' =>array(
	            	'url'=>'Yii::app()->createUrl("/cashreceipt/delete", array("id1"=>$data->emp_id, "id2"=>$data->period_id))',
	            	'options'=>array(
			        		'class'=>'btn btn-small btn-danger',
			        		'style'=>'margin:1px; padding:5px',
			        )
	            )
            ),
            'template'=>'{update}{delete}'
		),
	),
)); ?>