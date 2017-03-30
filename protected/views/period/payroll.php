<?php

$this->menu=array(
	array('label'=>'Create Period', 'url'=>array('create')),
	array('label'=>'Manage Period', 'url'=>array('admin')),
);
?>

<h1>Payroll</h1>
<table>
<tr>
<td> id </td>
<td>NAMA</td>
<td>TDK.MASUK</td>
<td>CUTI</td>
<td>SURAT.DOK</td>
<td>Permit</td>
<td>TELAT</td>
<td>LUPA ID</td>
<td>TEPAT WAKTU</td>
<td>DINAS</td>
<td>JML. PREMI</td>
<!-- td>GP</td>
<td>PREMI</td>
<td>allowance</td>
<td>ms kerja</td>
<td>t jab</td>
<td>t funct</td>
<td>kasbon</td>
<td>sisa kasbon</td>
<td>angsuran</td>
<td>no angsur</td>
<td>total gaji</td -->
</tr>
<?php
$total=0;
foreach ($dt as $key=>$value){
	$total = $value['biayaPremi']+$value['gp']+$value['allowance']+$value['tfunctional']+$value['tjabatan']+$value['tmasakerja']+$value['dapen']-$value['kasbon'];	
	?>
	<tr>
	<td> <?php	echo $value[emp_id];?></td>
	<td><?php echo $value[name]; ?></td>
	<td><?php echo $value['notin_work']; ?></td>
	<td><?php echo $value['cuti']; ?></td>
	<td><?php echo $value['surat_dokter']; ?></td>
	<td><?php echo $value['permit']; ?></td>
	<td><?php echo $value['telat']; ?></td>
	<td><?php echo $value['lupa_id']; ?></td>
	<td><?php echo $value['jml']; ?></td>
	<td><?php echo $value['dinas']; ?></td>
	<td><?php echo $value['totalPremi']; ?></td>
	
	<!-- td><?php echo yii::app()->hakamFormat->formatNumber($value['gp']);?></td -->
	
	<!-- td><?php echo yii::app()->hakamFormat->formatNumber($value['biayaPremi']);?></td -->
	<!-- td><?php echo yii::app()->hakamFormat->formatNumber($value['allowance']);?> </td>
	<td><?php echo yii::app()->hakamFormat->formatNumber($value['tmasakerja']);?></td>
	<td><?php echo yii::app()->hakamFormat->formatNumber($value['tjabatan']);?> </td>
	<td><?php echo yii::app()->hakamFormat->formatNumber($value['tfunctional']);?></td>
	
	<td><?php echo yii::app()->hakamFormat->formatNumber($value['kasbon']);?></td >
	<td><?php //echo yii::app()->hakamFormat->formatNumber($value['sisa_kasbon']);?></td>
	<td><?php //echo yii::app()->hakamFormat->formatNumber($value['angsuran']);?></td>
	<td><?php //echo $value['no_angsuran'];?></td -->
	
	<!-- td><?php echo yii::app()->hakamFormat->formatNumber($total);?></td -->
	<?php 
	$total=0;
} ?> 
</table>
