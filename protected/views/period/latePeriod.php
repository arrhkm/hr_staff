<?php 
$this->menu=array(
    array('label'=>'List Period', 'url'=>array('index')),
   
    array('label'=>'View Period', 'url'=>array('view', 'id'=>$id)),
);

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'emp_id',          // display the 'title' attribute
        'name',  // display the 'name' attribute of the 'category' relation
        'late_summary'
        //'content:html',   // display the 'content' attribute as purified HTML
        /*array(            // display 'create_time' using an expression
            'name'=>'create_time',
            'value'=>'date("M j, Y", $data->create_time)',
        ),
        array(            // display 'author.username' using an expression
            'name'=>'authorName',
            'value'=>'$data->author->username',
        ),*/

        //array(            // display a column with "view", "update" and "delete" buttons
        //    'class'=>'CButtonColumn',
        //),
    ),
));

?>