<?php
/* @var $this PermitdetilController */
/* @var $model Permitdetil */

/*	'Permitdetils'=>array('index'),
	'Manage',
);*/

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
<h1>Manage Dinas</h1>

<?php echo CHtml::beginForm(); ?>
<?php 

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'permitdetil-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows' => 2,	
	'columns'=>array(
		array(
            'id' => 'selectedIds',
            'class' => 'CCheckBoxColumn'
        ),
		/*
		array(
        //'name'=>'', 
        'value'=>'CHtml::checkBox("cid[]",null,array("value"=>$data[emp_id],"id"=>"cid_".$data[emp_id]))',
        'type'=>'raw',
        'htmlOptions'=>array('width'=>5),
        //'visible'=>false,
        ),*/

		'emp_id',
		'emp_name',		
		'dateout',
		'desout',
		
		array(
			'class'=>'CButtonColumn',
			'template' => '{delete}',
            'buttons' => array(
                'delete' => array( 
                	//'imageUrl'=>Yii::app()->request->baseUrl.'/image/check.png',
                	'url' => '$this->grid->controller->createUrl("Delete",array("emp_id"=>$data["emp_id"], "dateout"=>$data["dateout"]))',
               		'options'=>array('confirm'=>'Are you sure want to Delete this?'),
                ),
                
                
                /*'del2'=>array(
			                                 
			        'url' => 'Yii::app()->createUrl("dinas/delete", array("emp_id" => $data->emp_id, "dateout"=>$data->dateout))',
			        //'url' => '$this->grid->controller->createUrl("dinas/delete", array("emp_id" => $data->emp_id, "dateout"=>$data->dateout))',
			        'options'=>array('confirm'=>'Are you sure want to Delete this?'),
		        ),*/

            ),
		),
		
	),

));
?>

<div>
<?php //echo CHtml::submitButton('Approve', array('name' => 'ApproveButton')); ?>
<?php echo CHtml::submitButton('Delete Selected', 
array('name' => 'DeleteButton',
'confirm' => 'Are you sure you want to permanently delete these comments?'));
?>
</div>


<?php echo CHtml::endForm(); ?>

<?php 
if ($dt_id)
{

	foreach ($dt_id as $key ) {
		echo $key."<br>";

		$id = explode(",", $key);	
		echo "emp_id : ".$id[0];
		echo "date : ".$id[1]. "<br>";
	}
}

?>

