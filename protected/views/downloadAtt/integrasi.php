<?php
/* @var $this CardController */
/* @var $model Card */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
	'Inegrasi ',
);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'card-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'date1'); ?>
		<?php 
			//echo $form->textField($model, 'date1');
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				//'name'=>'date1', //this fields same as table fields
				'attribute'=>'date1', // setting current date same as database date
				'value'=>date('Y-m-d'), //setting save to table date format sach us 'Y-m-d', 'd-m-Y', 'm-d-Y'
				//'flat'=>true, //remove to hide the datepicker
				'model'=>$model,
				// additional javascript options for the date picker plugin
				'options'=>array(
					'showAnim'=>'slide',
					'dateFormat' => 'yy-mm-dd',
					'showButtonPanel'=>true,
				),
				'htmlOptions'=>array(
					'style'=>'height:20px;'
				),
			));
			
		?>
		<?php echo $form->error($model,'date1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date2'); ?>
		<?php 
		$this->widget('zii.widgets.jui.CJuiDatePicker',array(
			//'name'=>'datejm', //this fields same as table fields
			'attribute'=>'date2', // setting current date same as database date
			'value'=>date('Y-m-d'), //setting save to table date format sach us 'Y-m-d', 'd-m-Y', 'm-d-Y'
			//'flat'=>true, //remove to hide the datepicker
			'model'=>$model,
			// additional javascript options for the date picker plugin
			'options'=>array(
				'showAnim'=>'slide',
				'dateFormat' => 'yy-mm-dd',
				'showButtonPanel'=>true,
			),
			'htmlOptions'=>array(
				'style'=>'height:20px;'
			),
		));
		?>
		<?php echo $form->error($model,'date2'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php 
	$connect= yii::app()->db;
	echo $model->date1. " - ". $model->date2."<br>";
	echo "-----------------------------------------<br>";
	$sqlEmp="
	SELECT b.id, b.emp_id, a.name
	FROM card b, emp a
	WHERE a.id = b.emp_id 
	";
	$rsEmp=$connect->createCommand($sqlEmp)->queryAll();
	foreach($dtdate as $ini){
		//echo $ini."<br>";
		echo "----hasil in out  ".$ini['tgl']."-------<br>";
		foreach ($rsEmp as$kEmp=>$vEmp)
		{
			$sqlIn= "
			SELECT b.pin, b.status, b.dateatt, date(b.dateatt) as tgl, 
			a.id, a.name
			FROM emp a, engineatt b, card c 
			WHERE c.emp_id= a.id
			AND a.id= '$vEmp[emp_id]'
			AND b.pin= c.id 
			AND DATE(b.dateatt) ='$ini[tgl]'
			AND b.status=0
			ORDER BY b.dateatt ASC
			LIMIT 1
			";
			$rsIn= $connect->createCommand($sqlIn)->queryRow();
			if (empty($rsIn['dateatt'])){
				$punchIn = "NULL";
			} else $punchIn = $rsIn['dateatt'];

			$sqlOut= "
			SELECT b.pin, b.status, b.dateatt, date(b.dateatt) as tgl, 
			a.id, a.name
			FROM emp a, engineatt b, card c 
			WHERE c.emp_id= a.id
			AND a.id= '$vEmp[emp_id]'
			AND b.pin= c.id
			AND DATE(b.dateatt) ='$ini[tgl]'
			AND b.status=1
			ORDER BY b.dateatt Desc
			LIMIT 1
			";
			$rsOut= $connect->createCommand($sqlOut)->queryRow();
					
			if (empty($rsOut['dateatt'])){
				$punchOut="NULL";
			}else $punchOut=$rsOut['dateatt'];
			
			//echo $rsOut['tgl']." - ".$rsOut['pin']." - ".$rsOut['name']." - ".$rsIn['dateatt']." - ".$rsOut['dateatt']."<br>";
			echo $ini['tgl']." - ".$vEmp['id']." - ".$vEmp['name']." - ".$punchIn." - ".$punchOut."<br>";
		}
	}
?>