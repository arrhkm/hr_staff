<?php
/* @var $this DetilcutiController */
/* @var $model Detilcuti */

$this->breadcrumbs=array(
	'Cuti'=>array('cuti/'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Detilcuti', 'url'=>array('index')),
	//array('label'=>'Manage Detilcuti', 'url'=>array('admin')),
);
?>

<h1>Create Detilcuti</h1>

<?php $this->renderPartial('_form', array(
	'model'=>$model, 
	'dtDate'=>$dtDate,
	'dtNum'=>$dtNum,
)); 
?>
<?php 
$modelDetil= new Detilcuti;

		$criteria= new CDbCriteria;
		/*$criteria->compare('id',$id);
		$criteria->compare('cuti_id',$cuti_id);
		$criteria->compare('cuti_emp_id',$cuti_emp_id,true);
		$criteria->compare('kodecuti_id',$kodecuti_id);
		$criteria->compare('date_cuti',$date_cuti,true);
		*/
		
		$criteria->alias='a';
		$criteria->select= 'a.*, b.name as cuti_name';
		$criteria->join= 'JOIN kodecuti b ON (b.id = a.kodecuti_id)';
		$criteria->condition= 'a.cuti_id='.$_REQUEST[detilcuti_id];
		$criteria->compare('date_cuti',$date_cuti,true);

		$detilProvider = new CActiveDataProvider($modelDetil, array(
			'criteria'=>$criteria,
			
		));

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'detilcuti-grid',
	'dataProvider'=>$detilProvider, 
	//'filter'=>$modelDetil,
	'columns'=>array(
		'id',
		'cuti_id',
		'cuti_emp_id',
		'kodecuti_id',
		array('header'=>'nama cuti', 'value'=>'$data[cuti_name]'),		
		'date_cuti',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); 
?>