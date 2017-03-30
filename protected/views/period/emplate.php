<?php 
$this->menu=array(
    //array('label'=>'List Period', 'url'=>array('index')),
    array('label'=>'Period', 'url'=>array('view', 'id'=>$model->id)), 
    array('label'=>'Send Email', 'url'=>array('sendmailLate', 'periodId'=>$model->id)), 
    
);

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'a-grid-id',
    'dataProvider' => $model2,
    'ajaxUpdate' => true, //false if you want to reload aentire page (useful if sorting has an effect to other widgets)
    'filter' => null, //if not exist search filters
    'columns' => array(
 
       // array(
            //'header' => '',
           // 'name' => 'period_id',
            //'value'=>'$data["MAIN_ID"]', //in the case we want something custom
        //),
            
        'period_id',
        'emp_id',
        'name',
        'late_summary',
        'status_late',
        'send_late',
    ),
));

?>