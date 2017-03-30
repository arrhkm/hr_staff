<?php
/* @var $this PermitdetilController */
/* @var $model Permitdetil */

$this->breadcrumbs=array(
	'Permitdetils'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Permitdetil', 'url'=>array('index')),
	//array('label'=>'Create Permitdetil', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#permitdetil-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Permitdetils</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php /* $this->renderPartial('_search',array(
	'model'=>$model,
)); */?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'permitdetil-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'date_permit',
		//'permit_id',
		'permit_emp_id',
		'name',
		'permitcode_id',
		'codename',
		//array(
		//	'class'=>'CButtonColumn',
		//),
		
	),

)); ?>

<?php 
$this->widget(
	'booster.widgets.TbExtendedGridView',
	    array(
		    'fixedHeader' => true,
		    'headerOffset' => 40,
		    // 40px is the height of the main navigation at bootstrap
		    'type' => 'striped',
		    'dataProvider' => $model->search(),
		    'responsiveTable' => true,
		    'template' => "{items}",
		    'columns' => array(
		    	//'id',
				'date_permit',
				//'permit_id',
				'permit_emp_id',
				'name',
				'permitcode_id',
				'codename',
			),
		)
	);
?>
