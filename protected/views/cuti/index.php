<?php
/* @var $this CutiController */

$this->breadcrumbs=array(
	'Cuti',
);
?>



<?php 
$this->menu=array(
    array('label'=>'Add Cuti', 'url'=>array('cuti/create')),
   
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
            'header' => 'des',
            'name' => 'des',
            //'value'=>'$data["title"]', //in the case we want something custom
        ),          
 
       
        array( //we have to change the default url of the button(s)(Yii by default use $data->id.. but $data in our case is an array...)
            'class' => 'CButtonColumn',
            'template' => '{delete}{detil}',
            'buttons' => array(
                'delete' => array('url' => '$this->grid->controller->createUrl("cuti/delete",array("id"=>$data["id"]))'),
                'detil'=> array('url'=> '$this->grid->controller->createUrl("detilcuti/create", array("detilcuti_id"=>$data["id"], "emp_id"=>$data["emp_id"]))'),
            ),
        ),
    ),
));
?>
