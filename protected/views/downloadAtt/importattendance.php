    <?php
    $form = $this->beginWidget('CActiveForm', array(
    'id'=>'importcsv-form',
    'enableAjaxValidation'=> true,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>
     
   
    <h1>Import Absensi from Format CSV </h1>
    <p> [Tanggal], [emp_id], [jam in ], [jam out] </p>
    <p> 2014-03-22,S09078 08:00:00,17:00:00 </p>    
    <br>
     
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <?php //echo $form->labelEx($model,'kd_periode'); ?>
        <?php //echo $form->textField($model,'kd_periode'); ?>
        <?php //echo $form->dropDownList($model,'kd_periode',CHtml::listData(Periode::model()->findAll(array('order'=>'kd_periode DESC')),'kd_periode', 'kd_periode', 'nama_periode'), array('empty'=>'select Type')); ?>
        <?php //echo $form->error($model,'kd_periode'); ?>
    </div>
    <div class="row">
    <?php echo $form->labelEx($model,'file',array('class'=>'label')); ?>
    <?php echo $form->fileField($model,'file',array('class'=>'input')); ?>
    
    </div>
    
     
    <span class="button-group">
    <button type="submit" class="button icon-download">Submit</button>
    </span>
     
    <?php $this->endWidget(); 
        echo "ada ". $baris. " row inserted";

        if ($dt)
        {
            foreach ($dt as $datas)
            {
                echo "<br>".$datas['tgl']."  ". $datas['emp_id'] ." ". $datas['in'] ." ". $datas['out'];
            }
        }
    ?>
