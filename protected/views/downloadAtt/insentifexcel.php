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
     
   
    <h1>IMPORT INSENTIF DARI EXCEL </h1>
    
     
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
                                    <?php echo $form->labelEx($model,'kd_periode'); ?>                                
                                </div>
                                <div class="col-sm-9">
                                     <?php 
                                        $list= CHtml::ListData(Period::model()->findAll(array('order'=>'id DESC')), 'id', 'period_name');
                                        echo $form->dropDownList($model, 'kd_periode', $list);
                                    ?>
                                    <?php echo $form->error($model,'kd_periode'); ?>
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
	echo "Contoh template Insentif from excel : <br>";
	echo "<table>";
	echo "<tr><td>EMP_ID</td> <td>Name</td> <td>Value Insentif</td></td></tr>";
	echo "<tr><td>S0001</td> <td>PRABU SILIWANGI</td> <td>Rp 30.000.000,00</td></tr>";
	echo "</table>";
	
    if ($file){   
    	echo "Nama File  :".$file->name."<br>";
        echo "Lokasi / pacth file :".$spec."<br>";
    }
    
    ?>
    <div class="row">

    <?php
    if ($arraydata){

        echo "<div class='col-sm-12 col-md-12 col-lg-12'>";
        echo '<table class="table table-striped">';
        
        echo "<tr><td>id</td><td>kd periode</td><td>emp id</td><td>Nama</td><td>value</td></tr>";
        foreach ($arraydata as$key=>$data){
            echo "<tr>";
            echo "
                <td>".$id_max."</td>
                <td>".$kd_periode."</td>
                <td>".$data[0]."</td>
                <td>".$data[1]."</td>
                <td>".$data[2]."</td>
                

            ";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    }
    else 
    {
        echo "Data Tidak ada ";
    }

    echo $message;
    ?>
    </div>
