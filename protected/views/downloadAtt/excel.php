    <?php
    
    $form = $this->beginWidget('CActiveForm', array(
    'id'=>'importcsv-form',
    'enableAjaxValidation'=> true,
    'htmlOptions' => 
        array('enctype' => 'multipart/form-data'),

    ));
    ?>
    <?php 
    /*$form= $this->beginWidget('booster.widgets.TbActiveForm',
        array(
            'id' => 'verticalForm',
            'enableAjaxValidation'=>true,
            'htmlOptions' => 
            array(
                'class' => 'well',
                'enctype'=>'multipart/fomr-data',
            ), // for inset effect
        )
    );*/
    ?>
     
   
    <h1>IMPORT GAJI DARI EXCEL </h1>
    
     
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <?php echo $form->errorSummary($model); ?>
    
    <div class="row">
        <?php //echo $form->labelEx($model,'kd_periode'); ?>
        <?php 
            //echo $form->textField($model,'kd_periode'); 
            $list= CHtml::ListData(Period::model()->findAll(array('order'=>'id DESC')), 'id', 'period_name');
            //echo $form->dropDownList($model, 'kd_periode', $list);

        ?>
        <?php //echo $form->error($model,'kd_periode'); ?>
    </div>


    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class = "row">
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <?php //echo $form->labelEx($model,'kd_periode'); ?>                                
                                </div>
                                <div class="col-sm-9">
                                     <?php 
                                        $list= CHtml::ListData(Period::model()->findAll(array('order'=>'id DESC')), 'id', 'period_name');
                                        //echo $form->dropDownList($model, 'kd_periode', $list);
                                    ?>
                                    <?php //echo $form->error($model,'kd_periode'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">    
                                <div class="col-sm-3">
                                    <?php //echo $form->labelEx($model,'file', array('class'=>'control-label')); ?>
                                    <label for="file">File input</label>
                                </div>
                                <div class="col-sm-9">
                                       <?php echo $form->fileField($model,'file'); ?> 
                                </div>
                                <?php //echo $form->labelEx($model,'file',array('class'=>'label')); ?>          
                                <?php //echo $form->fileField($model,'file',array('class'=>'input')); ?>
                                <?php 
                                /*echo $form->fileFieldGroup($model, 'file',
                                    array(
                                        'wrapperHtmlOptions' => 
                                        array(
                                            'class' => 'col-sm-5',
                                        ),
                                    )
                                ); */
                                ?>                        
                            </div>  
                        </div>        
                        <div class="row">
                            <div class="form-group" style="margin:2px;">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Import</button>
                                </div>
                            </div> 
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>
    <?php 
    /*$this->widget(
        'booster.widgets.TbButton',
        array(
            'label' => 'Import',
            'context' => 'primary',
            'buttonType'=>'submit',
        )
    );*/

    ?>
     
    <?php $this->endWidget(); 
		echo "Contoh template Gaji Staff from excel : <br>";
		echo "<table>";
		echo "<tr>";
		echo "
			<td>EMP_ID</td> 
			<td>Name</td>
            <td>gp</td> 
			<td>T Masakerja</td>
			<td>T jabatan</td>
			<td>T Functional</td>			
			<td>T Allowance</td>
			<td>T Premi Hadir</td>
			<td>T Uang Makan</td>
			<td>T Dapen</td>
			";
		echo "</tr>";
		echo "<tr>";
		echo "
			<td>S0001</td> 
			<td>PRABU SILIWANGI</td> 
			<td>Rp 1.000.000,00</td>
			<td>Rp 2.000.000,00</td>
			<td>Rp 3.000.000,00</td>
			<td>Rp 4.000.000,00</td>
			<td>Rp 2.000.000,00</td>
			<td>Rp 10.000,00</td>
			<td>Rp 10.000,00</td>
			<td>Rp 200.000,00</td>
			";
		echo "</tr>";
		echo "</table>";
	
    if ($file){   
    	echo "Nama :".$file->name."<br>";
        echo "pacth :".$spec."<br>";
    }
    if ($arraydata){
        echo '<table border="1" style=" ">';
        //echo '<tr><td collspan=3 align = "center">DATA TEST</td></tr>';
        foreach ($arraydata as$key=>$data){
            echo "<tr>";
            echo "
                <td>".$data[0]."</td>
                <td>".$data[1]."</td>
                <td>".$data[2]."</td>
                <td>".$data[3]."</td>
                <td>".$data[4]."</td>
                <td>".$data[5]."</td>
                <td>".$data[6]."</td>
                <td>".$data[7]."</td>
                <td>".$data[8]."</td>
                <td>".$data[9]."</td>

            ";
            echo "</tr>";
        }
        echo "</table>";
    }
    else 
    {
        echo "Data Tidak ada ";
    }

    echo $message;
    ?>

