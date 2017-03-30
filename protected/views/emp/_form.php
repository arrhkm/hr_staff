<?php
/* @var $this EmpController */
/* @var $model Emp */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'emp-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php //echo $form->textField($model,'gender',array('size'=>1,'maxlength'=>1)); ?>		
		<?php 
			echo  $form->radioButtonList(
				$model,'gender',
				array('m'=>'male','f'=>'female'),
				array('separator'=>' ', 'labelOptions'=>array('style'=>'display:inline'))
			); 
		?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_job'); ?>
		<?php //echo $form->textField($model,'start_job'); 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'name'=>'start_job',
				'model'=>$model,'attribute'=>'start_job', 'value'=> date('Y-m-d'), 
				//'htmlOptions'=>array('style'=>'height:20px;', 'syle'=>'width:5px;'),
				'options'=>array('dateFormat'=>'yy-mm-dd', 'showButtonPanel'=>true, 'showAnim' =>'slide'),
			));
		?>
		<?php echo $form->error($model,'start_job'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'warm_contract'); ?>
		<?php //echo $form->textField($model,'warm_contract'); ?>
		<?php 
			echo  $form->radioButtonList(
				$model,'warm_contract',
				array(true=>'ON',false=>'OFF'),
				array('separator'=>' ', 'labelOptions'=>array('style'=>'display:inline'))
			); 
		?>
		<?php echo $form->error($model,'warm_contract'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'warm_date'); ?>
		<?php //echo $form->textField($model,'warm_date'); ?>
		<?php 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'name'=>'warm_date',
				'model'=>$model,'attribute'=>'warm_date', 'value'=> date('Y-m-d'), 
				//'htmlOptions'=>array('style'=>'height:20px;', 'syle'=>'width:5px;'),
				'options'=>array('dateFormat'=>'yy-mm-dd', 'showButtonPanel'=>true, 'showAnim' =>'slide'),
			));
		?>
		<?php echo $form->error($model,'warm_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'citizen_id'); ?>
		<?php echo $form->textField($model,'citizen_id',array('size'=>19,'maxlength'=>19)); ?>
		<?php echo $form->error($model,'citizen_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jamsostek_id'); ?>
		<?php echo $form->textField($model,'jamsostek_id',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'jamsostek_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bank_account'); ?>
		<?php echo $form->textField($model,'bank_account',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'bank_account'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'npwp'); ?>
		<?php echo $form->textField($model,'npwp',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'npwp'); ?>
	</div>
	<?php if (Yii::app()->user->level==9){ ?>
	<div class="row">
		<?php echo $form->labelEx($model,'gp'); ?>		
		<?php echo $form->textField($model,'gp',array('size'=>10,'maxlength'=>10, 'class'=>'number')); ?>			
		<?php echo $form->error($model,'gp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tmasakerja'); ?>
		<?php echo $form->textField($model,'tmasakerja',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'tmasakerja'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tjabatan'); ?>
		<?php echo $form->textField($model,'tjabatan',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'tjabatan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tfunctional'); ?>
		<?php echo $form->textField($model,'tfunctional',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'tfunctional'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'allowance'); ?>
		<?php echo $form->textField($model,'allowance',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'allowance'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'premi_hadir'); ?>
		<?php echo $form->textField($model,'premi_hadir',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'premi_hadir'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uang_makan'); ?>
		<?php echo $form->textField($model,'uang_makan',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'uang_makan'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dapen'); ?>
		<?php echo $form->textField($model,'dapen',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'dapen'); ?>
	</div>

	<?php } ?>

	<div class="row">
		<?php echo $form->labelEx($model,'stock_cuti'); ?>
		<?php echo $form->textField($model,'stock_cuti',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'stock_cuti'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($model,'partjob_id'); ?>
		<?php //echo $form->textField($model,'partjob_id'); ?>
		<?php 
			$list= CHtml::listData(Partjob::model()->findAll(), 'id', 'name');
			echo $form->dropDownList($model, 'partjob_id', $list, array('empty'=>'-- none --'));
		?>
		<?php echo $form->error($model,'partjob_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jobtitle_id'); ?>
		<?php //echo $form->textField($model,'jobtitle_id'); ?>
		<?php 
			$list= CHtml::listData(Jobtitle::model()->findAll(), 'id', 'name');
			echo $form->dropDownList($model, 'jobtitle_id', $list, array('empty'=>'-- none --'));
		?>
		<?php echo $form->error($model,'jobtitle_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'officetime_id'); ?>
		<?php //echo $form->textField($model,'jobtitle_id'); ?>
		<?php 
			$list= CHtml::listData(Officetime::model()->findAll(), 'id', 'name_time');
			echo $form->dropDownList($model, 'officetime_id', $list);
		?>
		<?php echo $form->error($model,'officetime_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'non_aktif'); ?>
		<?php echo $form->textField($model,'non_aktif',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'non_aktif'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'branch_id'); ?>
		<?php //echo $form->textField($model,'branch_id',array('size'=>4,'maxlength'=>4)); ?>
		<?php 
			$this->widget(
		    'booster.widgets.TbSelect2',
			    array(

				    'model'=>$model,
				    'attribute'=>'branch_id',			    
				    'name' => 'branch_id',			    
				    'data'=>array('1'=>'LDP','2'=>'LSF'),
				    'value'=>$model->branch_id,
				    'htmlOptions' => array(
					    //'multiple' => 'multiple',
					    'id' => 'issue-574-checker-select'
				    ),
				    'options' => array(
	                    'placeholder' => 'select',
	                    'width' => '30%',

	                ),
			    )
		    );		 
		?>
		<?php echo $form->error($model,'branch_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<script>
	$('input.number').keyup(function(event) 
	{
	       // skip for arrow keys
	       if(event.which >= 37 && event.which <= 40) return;
	       // format number
	       $(this).val(function(index, value) {
	             return value
	            .replace(/\D/g, '')
	            .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
	            ;
	       });
	});
	</script>

<?php $this->endWidget(); ?>

</div><!-- form -->