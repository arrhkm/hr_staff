<?php
/* @var $this DepartementController */
/* @var $model Departement */

$this->breadcrumbs=array(
	'Departements'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Departement', 'url'=>array('index')),
	array('label'=>'Create Departement', 'url'=>array('create')),
	array('label'=>'Update Departement', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Departement', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Departement', 'url'=>array('admin')),
	array('label'=>'Add Partjob', 'url'=>array('partjob', 'id'=>$model->id)),

);
?>

<h1>View Departement #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',		
		'name',
		'manager_id',
	),
)); ?>
<?php 
	$partjob = new Partjob;


?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'departement-grid',
	'dataProvider'=>$model_detil->getDetil($model->id),
	'filter'=>$model_detil,
	'columns'=>array(
		'id',		
		'name',
		'departement_id',
		array(
			'class'=>'CButtonColumn',
			'buttons'=>array(
	            /*'view' => array(
	                'label'=>'view',
	                'url'=>'Yii::app()->createUrl("/dailyreport/viewstaff", array("id"=>$data->id))',
                    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/password.png',
	            ),*/
	            'update' => array(
	                'label'=>'Update',
	                'url'=>'Yii::app()->createUrl("/departement/partjob", array("detil_id"=>$data[id], "id"=>$data[departement_id], "update"=>1))',
                    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/password.png',
	            ),
	            'delete' => array(
	            	'label'=>'Delete',
	            	'url'=>'Yii::app()->createUrl("departement/DeletePartjob/", array("detil_id"=>$data[id], "id"=>$data[departement_id]))', 
	            )
            ),
            'template'=>'{update}{delete}',
		),
	),
)); ?>