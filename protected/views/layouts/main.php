<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- Google Font -->
	<!-- link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css' -->

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />



	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id=""  style="width:100%;>

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<!-- div id="mainmenu" -->
	<!-- div id="mainMbMenu" -->
	<div id="TbNavbar" >
	<?php 
		//$this->widget('zii.widgets.CMenu',array(
		//$this->widget('application.extensions.mbmenu.MbMenu',
		$this->widget('booster.widgets.TbNavbar', 
			array(
				'brand' => 'HR-Staff',//CHtml::image($bUrl."/images/hr_payroll_logo.png"),
				'fixed' => 'top',
				'fluid' => true,
				'collapse' => true, // requires bootstrap-responsive.css
				'items'=>array(
					array(
						'class' => 'booster.widgets.TbMenu',
						'type' => 'navbar',
						'items' => array(

							array('label'=>'Home', 'url'=>array('/site/index')),
							array('label'=>'Tools', 'url'=>array('#'), 'items'=>array(
			                    array('label'=>'Download Engine Att', 'url'=>array('downloadAtt/')),
			                    array('label'=>'Download Engine Att LSF', 'url'=>array('downloadAtt/downloadLsf')),
			                    array('label'=>'Integrasi', 'url'=>array('downloadAtt/integrasi')),
			                    array('label'=>'Integrasi LSF', 'url'=>array('downloadAtt/integrasilsf')),
			                    array('label'=>'Tolate in the day', 'url'=>array('tolate/index')),
			                    array('label'=>'Kehadiran', 'url'=>array('kehadiran/index')),
			                    array('label'=>'Import Attendance', 'url'=>array('downloadAtt/importattendance')),
			                    array('label'=>'Import Gaji From CSV', 'url'=>array('downloadAtt/importgaji')),
			                    array('label'=>'Import Insentif From CSV', 'url'=>array('downloadAtt/importinsentif')),
			                    array('label'=>'Import Gaji From Excel', 'url'=>array('downloadAtt/excel')),
			                    array('label'=>'Import Insentif From Excel', 'url'=>array('downloadAtt/insentifexcel')),
			                    array('label'=>'Import Kasbon From Excel', 'url'=>array('downloadAtt/kasbonexcel')),

							)),
							array('label'=>'Master', 'url'=>array('#'), 
								'items'=>array(
									array('label'=>'User', 'url'=>array('user/')),
									array('label'=>'Employee', 'url'=>array('/emp')), 
									array('label'=>'Branch', 'url'=>array('/branch')),										
								
									array('label'=>'Card', 'url'=>array('card/')),
									array('label'=>'Card LSF', 'url'=>array('cardlsf/admin')),
									array('label'=>'Job Title', 'url'=>array('jobTitle/')),
									array('label'=>'Departemnt', 'url'=>array('Departement/admin')),
									array('label'=>'Manager', 'url'=>array('manager/admin')),
									array('label'=>'Part Job', 'url'=>array('Partjob/admin')),
									array('label'=>'Kode Cuti', 'url'=>array('Kodecuti/')),
									array('label'=>'Kode Ijin', 'url'=>array('Permitcode/')),
									array('label'=>'Period', 'url'=>array('Period/admin')),
									array('label'=>'Office Time', 'url'=>array('Officetime/')),
									array('label'=>'Hari Libur', 'url'=>array('dayoff/')),
									//array('label'=>'Out Area', 'url'=>array('Outarea/')),
								)
							),
							array('label'=>'Transaksi', 'items'=>array(								
								array('label'=>'Insentif', 'url'=>array('insentif/admin')),
								array('label'=>'Cash Receipt', 'url'=>array('cashreceipt/admin')),

							)),
							
							array('label'=>'Dinas New', 'items'=> array(
								array('label'=>'New', 'url'=>array('dinas/tambah')),
								array('label'=>'manage', 'url'=>array('dinas/admin'))
							)),
							array('label'=>'Cuti', 'url'=>array('cuti/'), 'items'=>array(
								array('label'=>'List Cuti', 'url'=>array('cuti/')),
								array('label'=>'Detil Cuti All', 'url'=>array('detilcuti/detilcutiall')),
							)),

							array('label'=>'Ijin', 'url'=>array('permit/'), 'items'=>array(						
									array('label'=>'Membuat Ijin', 'url'=>array('permit/')),
									array('label'=>'All Ijin', 'url'=>array('permitdetil/admin/')),
									array('label'=>'Surat Dokter', 'url'=>array('/suratdokter')),
							)),
							array('label'=>'Day Off', 'url'=>array('dayoff/')),
							//array('label'=>'Employee', 'url'=>array('/emp')),
							//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
							//array('label'=>'Contact', 'url'=>array('/site/contact')),
							array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
							array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Gii', 'url'=>array('gii/')),
						),
					),
				),
			)
		); 
	?>
	</div><!-- mainmenu -->

	<?php 
		
		/*echo "<br>User name : ".Yii::app()->user->name;
		echo "<br>User id: ".Yii::app()->user->id;
		echo "<br>level User : ".Yii::app()->user->getRoleName();
		*/
	
		//if (Yii::app()->user->isAdmin){
		//echo "<br>User Level: ".Yii::app()->user->level;}
				
			
	 ?>
	<?php if(isset($this->breadcrumbs)):?>
		<?php //$this->widget('zii.widgets.CBreadcrumbs', array(
		$this->widget('booster.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>


