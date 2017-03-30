<?php
/* @var $this PeriodController */
/* @var $model Period */

$this->breadcrumbs=array(
	'Periods'=>array('index'),
	$model->id,
);

$this->menu=array(
	//array('label'=>'List Period', 'url'=>array('index')),
    array('label'=>'Manage Period', 'url'=>array('admin')), //
	array('label'=>'Create Period', 'url'=>array('create')),
	array('label'=>'Update Period', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Period', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Day Off Period', 'url'=>array('dayoff', 'dayoff_id'=>$model->id)),
    array('label'=>'Generate Late', 'url'=>array('latePeriod', 'periodId'=>$model->id)),
    array('label'=>'Daftar Orang Telat', 'url'=>array('emplate', 'periodId'=>$model->id)),
);
?>

<h1>View Period #<?php echo $model->id; ?></h1>

<?php 
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'date_start',
		'date_end',
		'period_name',
	),
)); 
echo "<br> jumlah Hari kerja :".$hariKerja;
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'a-grid-id',
    'dataProvider' => $model2,
    'ajaxUpdate' => true, //false if you want to reload aentire page (useful if sorting has an effect to other widgets)
    'filter' => null, //if not exist search filters
    'columns' => array(
 
        array(
            'header' => 'Date / Tanggal Libur',
            'name' => 'id',
            //'value'=>'$data["MAIN_ID"]', //in the case we want something custom
        ),
        array(
            'header' => 'name/ Nama Liburan',
            'name' => 'name',
            //'value'=>'$data["title"]', //in the case we want something custom
        ),       
        //array( //we have to change the default url of the button(s)(Yii by default use $data->id.. but $data in our case is an array...)
            //'class' => 'CButtonColumn',
            /*'template' => '{delete}{detil}',
            'buttons' => array(
                'delete' => array('url' => '$this->grid->controller->createUrl("permit/delete",array("id"=>$data["id"]))'),
                'detil'=> array('url'=> '$this->grid->controller->createUrl("permitDetil/create", array("permit_id"=>$data["id"], "permit_emp_id"=>$data["emp_id"]))'),
            ),*/
        //),
    ),
));
foreach ($dtOff as $value){
    echo "<br>". $value[id];
}
echo "<br> hari sabtu minggu : ";
foreach($dtMinggu as $minggus){
    echo "<br> ".$minggus;
}
?>
