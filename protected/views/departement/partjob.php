<?php
/* @var $this DepartementController */
/* @var $model Departement */

$this->breadcrumbs=array(
	'Departements'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Departement', 'url'=>array('index')),
	array('label'=>'Manage Departement', 'url'=>array('admin')),
);
?>

<h1>Create Part Job Departement <?php echo $dep->name;?></h1>

<?php $this->renderPartial('_partjob', array('model'=>$model, 'dep'=>$dep)); ?>