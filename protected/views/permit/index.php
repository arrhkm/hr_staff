<?php
/* @var $this PermitController */
$this->breadcrumbs=array(
	'Permit',
);
?>



<?php 
$this->menu=array(
    array('label'=>'Add Permit', 'url'=>array('permit/create')),
   
);
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'a-grid-id',
    'dataProvider' => $model,
    'ajaxUpdate' => true, //false if you want to reload aentire page (useful if sorting has an effect to other widgets)
    'filter' => null, //if not exist search filters
    'columns' => array(
 
        array(
            'header' => 'id',
            'name' => 'id',
            //'value'=>'$data["MAIN_ID"]', //in the case we want something custom
        ),
        array(
            'header' => 'emp_id',
            'name' => 'emp_id',
            //'value'=>'$data["title"]', //in the case we want something custom
        ),
         array(
            'header' => 'name',
            'name' => 'name',
            //'value'=>'$data["title"]', //in the case we want something custom
        ),
          array(
            'header' => 'need',
            'name' => 'need',
            //'value'=>'$data["title"]', //in the case we want something custom
        ),        
          array(
            'header' => 'describe need',
            'name' => 'describe_need',            
        ),            
 
       
        array( //we have to change the default url of the button(s)(Yii by default use $data->id.. but $data in our case is an array...)
            'class' => 'CButtonColumn',
            'template' => '{delete}{detil}',
            'buttons' => array(
                'delete' => array('url' => '$this->grid->controller->createUrl("permit/delete",array("id"=>$data["id"]))'),
                'detil'=> array('url'=> '$this->grid->controller->createUrl("permitdetil/create", array("permit_id"=>$data["id"], "permit_emp_id"=>$data["emp_id"]))'),
            ),
        ),
    ),
));
?>
