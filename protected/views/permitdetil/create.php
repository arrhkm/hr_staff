<?php
/* @var $this PermitdetilController */
/* @var $model Permitdetil */

$this->breadcrumbs=array(
	'Permit'=>array('permit/'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Permitdetil', 'url'=>array('index')),
	//array('label'=>'Manage Permitdetil', 'url'=>array('admin')),
	//array('label'=>'List Permitdetil', 'url'=>array('index.php?r=permit')),
);
?>

<h1>Create Permitdetil</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php 
$modelDetil= new Permitdetil;
$criteria= new CDbCriteria;		
		$criteria->select= '*';
		$criteria->condition= 'permit_id='.$_REQUEST[permit_id];
		$detilProvider = new CActiveDataProvider($modelDetil, array(
			'criteria'=>$criteria,
		));
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detilcuti-grid',
	'dataProvider'=>$detilProvider, //$model->detil($_GET[emp_id]),
	//'filter'=>$model,
	'columns'=>array(
		'id',
		'permit_id',
		'date_permit',
		'permit_emp_id',
		'permitcode_id',		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); 
?>