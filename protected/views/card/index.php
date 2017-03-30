<?php
/* @var $this CardController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cards',
);

$this->menu=array(
	array('label'=>'Create Card', 'url'=>array('create')),
	array('label'=>'Manage Card', 'url'=>array('admin')),
);
?>

<h1>Cards</h1>

<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$sqlProvider,
	'itemView'=>'_view',
)); */

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'a-grid-id',
    'dataProvider' => $modelGrid,
    'ajaxUpdate' => true, //false if you want to reload aentire page (useful if sorting has an effect to other widgets)
    'filter' => null, //if not exist search filters
    'columns' => array(
 
        array(
            'header' => 'id',
            'name' => 'id',
            //'value'=>'$data["MAIN_ID"]', //in the case we want something custom
        ),
        array(
            'header' => 'emp Id',
            'name' => 'emp_id',
            //'value'=>'$data["title"]', //in the case we want something custom
        ),
        array(
            'header' => 'name',
            'name' => 'name',
            //'value'=>'$data["title"]', //in the case we want something custom
        ),
 
      
        array( //we have to change the default url of the button(s)(Yii by default use $data->id.. but $data in our case is an array...)
            'class' => 'CButtonColumn',
            'template' => '{delete}{view}{update}',
            'buttons' => array(
                'delete' => array('url' => '$this->grid->controller->createUrl("delete",array("id"=>$data["id"]))'),
                'view' => array('url' => '$this->grid->controller->createUrl("view",array("id"=>$data["id"]))'),
                'update' => array('url' => '$this->grid->controller->createUrl("update",array("id"=>$data["id"]))'),
            ),
        ),
    ),
));

?>
