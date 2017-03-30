    <?php
    $form = $this->beginWidget('CActiveForm', array(
    'id'=>'importcsv-form',
    'enableAjaxValidation'=> true,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>
     
   
    <h1>Import Insentif Staff Format CSV </h1>
    <p> emp_id, value </p>
    <p> S0xxxx, 2000000000 </p>    
    <br>
     
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <?php echo $form->errorSummary($model); ?>
    
    <div class="row">
        <?php echo $form->labelEx($model,'kd_periode'); ?>
        <?php 
            //echo $form->textField($model,'kd_periode'); 
            $list= CHtml::ListData(Period::model()->findAll(array('order'=>'id DESC')), 'id', 'period_name');
            echo $form->dropDownList($model, 'kd_periode', $list);

        ?>
        <?php echo $form->error($model,'kd_periode'); ?>
    </div>

    <div class="row">
    <?php echo $form->labelEx($model,'file',array('class'=>'label')); ?>
    <?php echo $form->fileField($model,'file',array('class'=>'input')); ?>
    
    </div>
    
     
    <span class="button-group">
    <button type="submit" class="button icon-download">Submit</button>
    </span>
     
    <?php $this->endWidget(); 
        echo "ada ". $baris. " row Updated .... ";
         echo "ada ". $kd_periode. " row Updated .... ";

        if ($dt)
        {
            foreach ($dt as $datas)
            {
                echo "<br> emp_id : ".$datas['emp_id']."  Value insentif : ". $datas['value']."   ke periode: ". $datas['kd_periode'];                
            }
        }
    ?>
