<?php
/* @var $this EmpController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tolate',
);

$this->menu=array(
	array('label'=>'Send Email', 'url'=>array('sendEmail')),
	//array('label'=>'Manage Emp', 'url'=>array('admin')),
);
?>

<h1>Tolate in the day</h1>

<?php /*$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));*/?>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
//$this->widget('zii.widgets.CListView', array(
    'id' => 'a-grid-id',
    'dataProvider' => $dataProvider,
    'ajaxUpdate' => true, //false if you want to reload aentire page (useful if sorting has an effect to other widgets)
    'filter' => null, //if not exist search filters
    'columns' => array(
 
        array(
            'header' => 'Date Job',
            'name' => 'date_job',
            //'value'=>'$data["MAIN_ID"]', //in the case we want something custom
        ),
        array(
            'header' => 'Emp Id',
            'name' => 'emp_id',
            //'value'=>'$data["title"]', //in the case we want something custom
        ),
        array(
            'header' => 'Emp Name',
            'name' => 'name',
            //'value'=>'$data["title"]', //in the case we want something custom
        ),
        array(
            'header' => 'IN',
            'name' => 'dt_in',
            //'value'=>'$data["title"]', //in the case we want something custom
        ),
        array(
            'header' => 'OUT',
            'name' => 'dt_out',
            //'value'=>'$data["title"]', //in the case we want something custom
        ),       
 
        /*array( //we have to change the default url of the button(s)(Yii by default use $data->id.. but $data in our case is an array...)
            'class' => 'CButtonColumn',
            'template' => '{delete}',
            'buttons' => array(
                'delete' => array('url' => '$this->grid->controller->createUrl("delete",array("id"=>$data["MAIN_ID"]))'),
            ),
        ),*/
		
    ),
	//'itemView'=>'_view',
));
?>