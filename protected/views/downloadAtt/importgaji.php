    <?php
    $form = $this->beginWidget('CActiveForm', array(
    'id'=>'importcsv-form',
    'enableAjaxValidation'=> true,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>
     
   
    <h1>IMport Gaji Staff Format CSV </h1>
    <p> emp_id, nama, gp,  T-masakerja, T-jabatan, T-functional, allowance, premi hadir, uang makan, dapen </p>
    <p> S0xxxx, M. SUXXXXX, 2500000, 300000, 0, 0, 0, 10000, 0, '2015-02-10' </p>    
    <br>
     
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <?php echo $form->errorSummary($model); ?>
    
    <div class="row">
    <?php echo $form->labelEx($model,'file',array('class'=>'label')); ?>
    <?php echo $form->fileField($model,'file',array('class'=>'input')); ?>
    
    </div>
    
     
    <span class="button-group">
    <button type="submit" class="button icon-download">Submit</button>
    </span>
     
    <?php $this->endWidget(); 
		
        echo "ada ". $baris. " row Updated .... ";

        if ($dt)
        {
            foreach ($dt as $datas)
            {
                echo "<br>".$datas['emp_id']."  ". $datas['gp'] 
                ." ". $datas['tmaskaerja'] 
                ." ". $datas['tjabatan']
                ."  ". $datas['tfunctional']
                ."  ". $datas['gp']
                ."  ". $datas['allowance']
                ."  ". $datas['premi_hadir']
                ."  ". $datas['uang_makan']
                ."  ". $datas['dapen'];                
            }
        }
    ?>
