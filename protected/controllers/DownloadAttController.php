<?php

class DownloadAttController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('integrasi2'),
				'users'=>array('*'),
			),
			
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index', 'importattendance', 'importgaji', 'integrasi', 'importinsentif',
				'integrasilsf', 'downloadlsf'),				
				'expression'=>'$user->isPayroll()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index', 'importattendance', 'importgaji', 
				'integrasi', 'importinsentif', 'Excel', 'insentifexcel', 'kasbonexcel', 'integrasilsf',
				'downloadlsf'),								
				'expression'=>'$user->isAdmin()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
		//$dt_array=array();
		$sensorid=1;
		$IP= "192.168.100.136";
		$Key= 80;
		$Connect = fsockopen($IP, "80", $errno, $errstr, 1);
		if($Connect){
			$ket=1;
			$soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
			$newLine="\r\n";
			fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
		    fputs($Connect, "Content-Type: text/xml".$newLine);
		    fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
		    fputs($Connect, $soap_request.$newLine);
			$buffer="";
			while($Response=fgets($Connect, 1024)){
				$buffer=$buffer.$Response;
			}
		}else $ket=0;
		
		//include("parse.php");
		yii::import('application.extensions.att.parse');
		//
		$buffer=$this->Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
		$buffer=explode("\r\n",$buffer);
		for($a=1;$a<count($buffer);$a++){
			$data=$this->Parse_Data($buffer[$a],"<Row>","</Row>");
			$PIN=$this->Parse_Data($data,"<PIN>","</PIN>");
			$DateTime=$this->Parse_Data($data,"<DateTime>","</DateTime>");
			$Verified=$this->Parse_Data($data,"<Verified>","</Verified>");
			$Status=$this->Parse_Data($data,"<Status>","</Status>");
			
			if ($PIN <> 0 ) { 
				$query="INSERT IGNORE engineatt(pin, dateatt, verified, status) 
				VALUES ( $PIN,'$DateTime', $Verified, $Status)
				;";
				$connect= yii::app()->db;
				$connect->createCommand($query)->query();
											
				$dt_array[$a]['PIN']=$PIN;
				$dt_array[$a]['DateTime']=$DateTime;
				$dt_array[$a]['Verified']=$Verified;
				$dt_array[$a]['Status']=$Status;
				$dt_array[$a]['SensorId']= $sensorid;
			}
			
		}
		

		$this->render('index', array(
                    'dt_array'=>$dt_array, 
                    //'hakam'=>$hakam
                ));
	}

	public function actionDownloadLsf()
	{
		
		/*
		$dbName = "//192.168.100.26/att_lsf/att2000.mdb";
		$string_conn = "odbc:DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=$dbName; Uid=; Pwd=;";
		
		if (!file_exists($dbName)) {
			die("Could not find database file.");
		}
		$db_access = new PDO($string_conn);//Connection PDO ODBC	
		*/
		$model = new IntegrasiForm;
		if (isset($_POST['IntegrasiForm'])){
			
			$model->attributes=$_POST['IntegariForm'];
			
			$model->date1= $_POST['IntegrasiForm']['date1'];
			$model->date2= $_POST['IntegrasiForm']['date2'];

			$query_inout="SELECT b.USERID, b.SENSORID,  b.VERIFYCODE, b.CHECKTYPE, b.CHECKTIME,
			a.Badgenumber, a.Name
			FROM USERINFO as a , CHECKINOUT as b 
			WHERE b.USERID=a.USERID 
			AND (Format([CHECKTIME],'yyyy-mm-dd')>='$model->date1' AND Format([CHECKTIME],'yyyy-mm-dd')<='$model->date2') 

			";
			//AND b.SENSORID=2
			//ORDER BY a.USERID'	
			//a.Badgenumber, a.Name,
			//Format(b.CHECKTIME,'yyyy-mm-dd') AS Tanggal_Log, 
			//Format(b.CHECKTIME,'hh:nn:ss') AS H_Log, b.CHECKTIME, 
			//AND FORMAT(b.CHECKTIME, 'yyyy-mm-dd') BETWEEN '2015-05-01' AND '2015-05-07' 	
			//$result = $db_access->query($query_inout);//pdo_odbc//1	
			//$result = Yii::app()->dbAccess->createCommand('SELECT * FROM USERINFO a, CHECKINOUT b WHERE b.USERID = a.USERID')->queryAll();
			$result = Yii::app()->dbAccess->createCommand($query_inout)->queryAll();
		}
		if ($result){
			//while($row = $result->fetch(PDO::FETCH_ASSOC)) //0	
			foreach ($result as $row)		
			{
				$pin = $row[Badgenumber];
				//$userid=$dt_access['Fid'];
				$sensorid = $row[SENSORID];
				$userid = $row[Badgenumber];//$userid=odbc_result($dt_access,"Badgenumber");			 
				//$checktime=$dt_access['DateTime'];
				$checktime= $row[CHECKTIME];//$checktime=odbc_result($dt_access,"CHECKTIME");
				//$verifycode=$dt_zsoft['In_out'];
				$verifycode = $row[CHECKTYPE];//$verifycode=odbc_result($dt_access,"CHECKTYPE");
				//$status=$dt_zsoft['Verifikasi'];
				$status = $row[VERIFYCODE]; //$status=odbc_result($dt_access,"VERIFYCODE");
				//$tanggal_log= $dt_zsoft['Tanggal_Log'];
				$tanggal_log = $row[Tanggal_Log];//$tanggal_log=odbc_result($dt_access,"Tanggal_Log");
				//$jam_log= $dt_zsoft['H_Log'];
				$dt[$i]['sensorid']= $sensorid;
				$dt[$i]['userid']= $userid;
				$dt[$i]['name']= $row[Name];
				$dt[$i]['status']=$row[CHECKTYPE]; 
				$dt[$i]['dateatt']= $row[CHECKTIME];
				$i++;

				$query="INSERT IGNORE engineattlsf(pin, dateatt, status, machine_id) 
				VALUES ( $pin,'$checktime', '$verifycode', $sensorid)
				;";

				yii::app()->db->createCommand($query)->query();
			}
			
		}

		$this->render('downloadlsf', array('model'=>$model, 'hasil'=>$dt));

	}

	public function actionIntegrasi()
	{
		$model=New IntegrasiForm;
		$connect= yii::app()->db;

		if (isset($_POST['IntegrasiForm'])){
			
			$model->attributes=$_POST['IntegrasiForm'];
			
			$model->date1= $_POST['IntegrasiForm']['date1'];
			$model->date2= $_POST['IntegrasiForm']['date2'];
			$sqlNol= "
				UPDATE engineatt
				SET status=0
				WHERE 
				date(dateatt) between '$model->date1' AND '$model->date2'			
				AND time_to_sec(time(dateatt)) < time_to_sec('13:00:00')
				AND status= 1
			";
			$sqlOne = "
				UPDATE engineatt
				SET status=1
				WHERE 
				date(dateatt) between '$model->date1' AND '$model->date2'			
				AND time_to_sec(time(dateatt)) >= time_to_sec('13:00:00')
				AND status= 0
			";
			//$connect->createCommand($sqlNol)->query();//Di off kan biar cepat
			//$connect->createCommand($sqlOne)->query();//Di off kan biar cepat
			$sql="
				SELECT  distinct (date(dateatt)) as tgl
				from engineatt
				WHERE date(dateatt) between '$model->date1' AND '$model->date2'				
			";
			$dtdate= $connect->createCommand($sql)->queryAll();

			foreach($dtdate as $ini){
				$dt[]= $ini['tgl'];//
				$sqlEmp="
					SELECT b.id, b.emp_id, a.name
					FROM card b, emp a
					WHERE a.id = b.emp_id 
					";
				//looping employee	
				
				$rsEmp=$connect->createCommand($sqlEmp)->queryAll();
				$punchIn="NULL";
				$punchOut="NULL";
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
					
					$rsIn= $connect->createCommand($sqlIn)->queryRow();
					if (empty($rsIn['dateatt'])){
						$punchIn = "NULL";
					} else $punchIn = $rsIn['dateatt'];

					$rsOut= $connect->createCommand($sqlOut)->queryRow();
					if (empty($rsOut['dateatt'])){
						$punchOut="NULL";
					}else $punchOut=$rsOut['dateatt'];				
					
					
					if (!($punchIn ==="NULL")&& ($punchOut==="NULL")){
						$sqlIgnore="
						REPLACE INTO attendance (date_job, emp_id, dt_in ) VALUES ('$ini[tgl]', '$vEmp[emp_id]', '$punchIn');
						";
					} elseif(($punchOut !="NULL") && ($punchIn==="NULL")){
						$sqlIgnore="
						REPLACE INTO attendance (date_job, emp_id, dt_out ) VALUES ('$ini[tgl]', '$vEmp[emp_id]', '$punchOut');
						";
					}
					
					if(!($punchIn==="NULL") && !($punchOut ==="NULL")){
						$sqlIgnore="
						REPLACE INTO attendance (date_job, emp_id, dt_in, dt_out ) VALUES ('$ini[tgl]', '$vEmp[emp_id]', '$punchIn', '$punchOut');
						";
						//yii::app()->db->createCommand($sqlIgnore)->query();
					}

					//$sqlIgnore="
					//REPLACE INTO attendance (date_job, emp_id, dt_in, dt_out ) VALUES ('$ini[tgl]', '$vEmp[emp_id]', $punchIn, $puncOut);
					//";
					yii::app()->db->createCommand($sqlIgnore)->query();
					
					/*
					$sqlIgnore="
						REPLACE INTO attendance (date_job, emp_id, dt_in, dt_out) VALUES ('$ini[tgl]', '$vEmp[emp_id]', '$punchIn', $punchOut);
					";
					yii::app()->db->createCommand($sqlIgnore)->query();
					*/
					//Yii::app()->db->createCommand()->insertIgnore('Attendance', array('date_job'=>$ini[tgl], 'emp_id'=>$vEmp[emp_id],
						//'dt_in'=>$vIn[dateatt], 'dt_out'=>$vOut[dateatt],
    				//));
    				
				}
				
			}

		}
		$this->render('integrasi', array(
                    'model'=>$model, 
                    //'hkm'=>$hkm, 
                    'dtdate'=>$dtdate,
                ));

	}

	public function actionIntegrasi2()
	{
		$model=New IntegrasiForm;
		$connect= yii::app()->db;
		//$tgl_ini = '2014-12-12';
		$tgl_ini = date('Y-m-d');
		
			$sql="
				SELECT  distinct (date(dateatt)) as tgl
				from engineatt
				WHERE date(dateatt) ='$tgl_ini'				
			";
			$dtdate= $connect->createCommand($sql)->queryAll();

			foreach($dtdate as $ini){
				$dt[]= $ini['tgl'];//
				$sqlEmp="
					SELECT b.id, b.emp_id, a.name
					FROM card b, emp a
					WHERE a.id = b.emp_id
					";
				//looping employee	
				
				$rsEmp=$connect->createCommand($sqlEmp)->queryAll();
				$punchIn=NULL;
				$punchOut=NULL;
				foreach ($rsEmp as$kEmp=>$vEmp)
				{
					$Attendance= New Attendance;
					
					$Attendance->date_job= $ini[tgl];
					$Attendance->emp_id= $vEmp[emp_id];	

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
					$rsIn= $connect->createCommand($sqlIn)->query();
					$punchIn="";
					foreach($rsIn as $kIn=>$vIn){						
						if (empty($vIn[dateatt])){
							$punchIn="";
						}else {
							$punchIn= $vIn[dateatt];
						}
					}
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
					$rsOut= $connect->createCommand($sqlOut)->queryAll();
					//$result= $command->execute();
					$punchOut="";
					foreach ($rsOut as $kOut=>$vOut){
						if (empty($vOut[dateatt])){
							$punchOut="";
						}else {
							$punchOut=$vOut[dateatt];
						}
					}
					
					$sqlIgnore="
						REPLACE INTO attendance (date_job, emp_id, dt_in, dt_out) VALUES ('$ini[tgl]', '$vEmp[emp_id]', '$punchIn', '$punchOut');
					";
					yii::app()->db->createCommand($sqlIgnore)->query();
					//Yii::app()->db->createCommand()->insertIgnore('Attendance', array('date_job'=>$ini[tgl], 'emp_id'=>$vEmp[emp_id],
						//'dt_in'=>$vIn[dateatt], 'dt_out'=>$vOut[dateatt],
    				//));
    				
				}
				
			}

		
		//$this->render('integrasi2', array('model'=>$model, 'hkm'=>$hkm, 'dt'=>$dt));

	}

	public function Parse_Data($data,$p1,$p2) 
	{
		$data=" ".$data;
		$hasil="";
		$awal=strpos($data,$p1);
		if($awal!=""){
			$akhir=strpos(strstr($data,$p1),$p2);
			if($akhir!=""){
				$hasil=substr($data,$awal+strlen($p1),$akhir-strlen($p1));
			}
		}
		return $hasil;	
	}

	public function actionImportAttendance()
	{
		$model = new ImportCsv;

		if (isset($_POST['ImportCsv'])) {
			$model->attributes = $_POST['ImportCsv'];
			$file = CUploadedFile::getInstance($model, 'file');
			if (($fp = fopen($file->tempName, "r")) !== false) {
				$baris=0;
				$dt= array();
				while (($line = fgetcsv($fp, 1000, ",")) !== false) {
					//$new_csv = new Attendance;
					//$new_csv->date_job = $line[0];
					//$new_csv->emp_id = $line[1];
					//$new_csv->h_in = $line[2];
					//$new_csv->h_out = $line[3];

					$in = $line[0]." ".$line[2];
					$out= $line[0]." ".$line[3];

					$dt_in= $in;
					$dt_out= $out;

					$dt[$baris]['tgl']= $line[0];
					$dt[$baris]['emp_id']=  $line[1];					
					$dt[$baris]['in']= $in;
					$dt[$baris]['out']= $out;

					//$new_csv->wt = $line[4];
					//$new_csv->ot = $line[5];
					//$new_csv->descript = $line[6];
					$sql = "REPLACE INTO attendance (date_job, emp_id, dt_in, dt_out) 
					VALUE ('$line[0]', '$line[1]', '$dt_in', '$dt_out')
					";
					yii::app()->db->createCommand($sql)->query();
					//$new_csv->save();
					
					$baris++;
				}
				fclose($fp);
				//$this->redirect(array('importJmCsv'));
				//$this->redirect(array ('hasilImport', 'baris'=>$baris));
			}
		}

		$this->render('importattendance', 
			array(
				'model'=>$model,
				'baris'=>$baris,
				'dt'=>$dt,
		));
	}

	public function actionImportGaji()
	{
		$model = new ImportCsv;

		if (isset($_POST['ImportCsv'])) {
			$model->attributes = $_POST['ImportCsv'];
			$file = CUploadedFile::getInstance($model, 'file');
			if (($fp = fopen($file->tempName, "r")) !== false) {
				$baris=0;
				$dt= array();
				while (($line = fgetcsv($fp, 1000, ",")) !== false) {
					
					$emp_id = $line[0];
					$gp= $line[0];

					$dt_in= $in;
					$dt_out= $out;

					$dt[$baris]['emp_id']= $line[0];//1
					$dt[$baris]['gp']=  $line[2];		//3		
					$dt[$baris]['tmasakerja']= $line[3];//4
					$dt[$baris]['tjabatan']= $line[4];//5
					$dt[$baris]['tfunctional']= $line[5];//6
					$dt[$baris]['allowance']= $line[6];//7
					$dt[$baris]['premi_hadir']= $line[7];//8
					$dt[$baris]['uang_makan']= $line[8];//9
					$dt[$baris]['dapen']= $line[9];//10
					//$dt[$baris]['warm_date']= $line[10];
					
					$sql = "UPDATE emp  
					SET  gp= $line[2], tmasakerja= $line[3], tjabatan = $line[4], tfunctional = $line[5], allowance= $line[6], premi_hadir = $line[7], uang_makan= $line[8], dapen= $line[9]
					WHERE id = '$line[0]'";
					yii::app()->db->createCommand($sql)->query();
					//$new_csv->save();
					
					$baris++;
				}
				fclose($fp);
				//$this->redirect(array('importJmCsv'));
				//$this->redirect(array ('hasilImport', 'baris'=>$baris));
			}
		}

		$this->render('importgaji', 
			array(
				'model'=>$model,
				'baris'=>$baris,
				'dt'=>$dt,
		));
	}

	public function actionImportInsentif()
	{
		$model = new ImportCsv;
		$id_max=0;
		if (isset($_POST['ImportCsv'])) {
			$max= yii::app()->db->createCommand("SELECT MAX(id) FROM insentif")->queryScalar();
			$id_max= $max+1;
			$model->attributes = $_POST['ImportCsv'];
			$kd_periode= $_POST['ImportCsv']['kd_periode'];
			$file = CUploadedFile::getInstance($model, 'file');
			if (($fp = fopen($file->tempName, "r")) !== false) {
				$baris=0;
				$dt= array();
				while (($line = fgetcsv($fp, 1000, ",")) !== false) {
					
					
					$dt[$baris]['emp_id']= $line[0];//1
					$dt[$baris]['value']=  $line[1];
					$dt[$baris]['kd_periode']=  $_POST['ImportCsv']['kd_periode'];		//3		
					
 				
					$sql = "INSERT IGNORE insentif (id, period_id, emp_id, value)
					VALUE  ($id_max, $kd_periode, '$line[0]', $line[1])";
					yii::app()->db->createCommand($sql)->query();

					$id_max++;
					$baris++;
				}
				fclose($fp);				
			}
		}

		$this->render('importinsentif', 
			array(
				'model'=>$model,
				'baris'=>$baris,
				'dt'=>$dt,
				'kd_periode'=> $_POST['ImportCsv']['kd_periode'],
		));
	}

	public function actionExcel()
	{
		$model = new FormExcel;			
		if(isset($_POST['FormExcel'])){			

			$model->attributes= $_POST['FormExcel'];
			$file= CUploadedFile::getInstance($model, 'file');

			$spec = Yii::app()->basePath.'/file/'.$file->name;
			$file->saveAs($spec);
			//  Include PHPExcel_IOFactory
			//include 'PHPExcel/IOFactory.php';
			//Yii::import('ext.PHPExcel.Classes.vendor.PHPExcel');  
			spl_autoload_unregister(array('YiiBase','autoload'));  
			require(Yii::app()->basePath.'/vendor/PHPExcel/PHPExcel.php');
			spl_autoload_register(array('YiiBase', 'autoload'));	
			
			//$inputFileName = $file;
			
			try 
			{			
				$inputFileType = PHPExcel_IOFactory::identify($spec);
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
				$objReader->setReadDataOnly(true);

				$objPHPExcel = $objReader->load($spec);//Load $inputFileName to a PHPExcel Object
				$total_sheets=$objPHPExcel->getSheetCount(); 

				$allSheetName=$objPHPExcel->getSheetNames(); 
				$objWorksheet = $objPHPExcel->setActiveSheetIndex(0); 
				$highestRow = $objWorksheet->getHighestRow(); 
				$highestColumn = $objWorksheet->getHighestColumn();  
				$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);  
				for ($row = 2; $row <= $highestRow;++$row) 
				{  
				    for ($col = 0; $col <$highestColumnIndex;++$col)
				    {  
				        $value=$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();  
				              $arraydata[$row-1][$col]=$value; 				              
				    }  
				}
			}
			catch (Exception $e)
			{
				$message = 'There was a problem handling your file. Technical details: '.$e->getMessage();
			}
			if (! empty($message))
			{
				Yii::app()->user->setFlash('error',$message);
			}
			if ($arraydata){
				foreach ($arraydata as $key=>$value){
					$sqlupdate= "UPDATE emp  
						SET  gp= $value[2], tmasakerja= $value[3], tjabatan = $value[4], tfunctional = $value[5], allowance= $value[6], premi_hadir = $value[7], uang_makan= $value[8], dapen= $value[9]
						WHERE id = '$value[0]'";
					yii::app()->db->createCommand($sqlupdate)->query();
				}
			}	
			unlink($spec);

					
		}
		$this->render('excel', 
			array(
				'model'=>$model,
				'file'=>$file,				
				'kd_periode'=> $_POST['FormExcel']['kd_periode'],
				'arraydata'=>$arraydata,
				'message'=>$message,
				'spec'=>$spec,
		));
	}

	public function actionInsentifExcel()
	{
		$model = new FormExcel;
		$id_max=0;
		
		if(isset($_POST['FormExcel'])){
			$model->attributes= $_POST['FormExcel'];
			$file= CUploadedFile::getInstance($model, 'file');
			$kd_periode =$_POST['FormExcel']['kd_periode'];
			$spec = Yii::app()->basePath.'/file/'.$file->name;
			$file->saveAs($spec);
			
			spl_autoload_unregister(array('YiiBase','autoload'));  
			require(Yii::app()->basePath.'/vendor/PHPExcel/PHPExcel.php');
			spl_autoload_register(array('YiiBase', 'autoload'));	
			
			$max= yii::app()->db->createCommand("SELECT MAX(id) FROM insentif")->queryScalar();
			$id_max= $max+1;
			
			try 
			{			
				$inputFileType = PHPExcel_IOFactory::identify($spec);
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
				$objReader->setReadDataOnly(true);

				$objPHPExcel = $objReader->load($spec);//Load $inputFileName to a PHPExcel Object
				$total_sheets=$objPHPExcel->getSheetCount(); 

				$allSheetName=$objPHPExcel->getSheetNames(); 
				$objWorksheet = $objPHPExcel->setActiveSheetIndex(0); 
				$highestRow = $objWorksheet->getHighestRow(); 
				$highestColumn = $objWorksheet->getHighestColumn();  
				$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);  
				for ($row = 2; $row <= $highestRow;++$row) 
				{  
				    for ($col = 0; $col <$highestColumnIndex;++$col)
				    {  
				        $value=$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();  
				              $arraydata[$row-1][$col]=$value; 				              
				    }  
				}
			}
			catch (Exception $e)
			{
				$message = 'There was a problem handling your file. Technical details: '.$e->getMessage();
			}
			if (! empty($message))
			{
				Yii::app()->user->setFlash('error',$message);
			}
			
			if ($arraydata){
				foreach ($arraydata as $key=>$value){
					$sql = "INSERT IGNORE insentif (id, period_id, emp_id, value)
					VALUES  ($id_max, $kd_periode, '$value[0]', $value[2])";
					yii::app()->db->createCommand($sql)->query();
					$id_max++;
				}
			}
			unlink($spec);

					
		}
		$this->render('insentifexcel', 
			array(
				'model'=>$model,
				'file'=>$file,				
				'kd_periode'=> $_POST['FormExcel']['kd_periode'],
				'arraydata'=>$arraydata,
				'message'=>$message,
				'spec'=>$spec,
				'id_max'=>$id_max
		));
	}

	//------------------------
	public function actionKasbonExcel()
	{
		$model = new FormExcel;
		$id_max=0;
		
		if(isset($_POST['FormExcel'])){
			$model->attributes= $_POST['FormExcel'];
			$file= CUploadedFile::getInstance($model, 'file');
			$kd_periode =$_POST['FormExcel']['kd_periode'];
			$spec = Yii::app()->basePath.'/file/'.$file->name;
			$file->saveAs($spec);
			
			spl_autoload_unregister(array('YiiBase','autoload'));  
			require(Yii::app()->basePath.'/vendor/PHPExcel/PHPExcel.php');
			spl_autoload_register(array('YiiBase', 'autoload'));	
			
			//$max= yii::app()->db->createCommand("SELECT MAX(id) FROM insentif")->queryScalar();
			//$id_max= $max+1;
			
			try 
			{			
				$inputFileType = PHPExcel_IOFactory::identify($spec);
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
				$objReader->setReadDataOnly(true);

				$objPHPExcel = $objReader->load($spec);//Load $inputFileName to a PHPExcel Object
				$total_sheets=$objPHPExcel->getSheetCount(); 

				$allSheetName=$objPHPExcel->getSheetNames(); 
				$objWorksheet = $objPHPExcel->setActiveSheetIndex(0); 
				$highestRow = $objWorksheet->getHighestRow(); 
				$highestColumn = $objWorksheet->getHighestColumn();  
				$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);  
				for ($row = 2; $row <= $highestRow;++$row) 
				{  
				    for ($col = 0; $col <$highestColumnIndex;++$col)
				    {  
				        $value=$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();  
				              $arraydata[$row-1][$col]=$value; 				              
				    }  
				}
			}
			catch (Exception $e)
			{
				$message = 'There was a problem handling your file. Technical details: '.$e->getMessage();
			}
			if (! empty($message))
			{
				Yii::app()->user->setFlash('error',$message);
			}
			
			if ($arraydata){
				foreach ($arraydata as $key=>$value){
					$sql = "INSERT IGNORE cashreceipt (emp_id, period_id, value)
					VALUES  ('$value[0]', $kd_periode, $value[2])";
					yii::app()->db->createCommand($sql)->query();
					//$id_max++;
				}
			}
			unlink($spec);

					
		}
		$this->render('kasbonexcel', 
			array(
				'model'=>$model,
				'file'=>$file,				
				'kd_periode'=> $_POST['FormExcel']['kd_periode'],
				'arraydata'=>$arraydata,
				'message'=>$message,
				'spec'=>$spec,
				//'id_max'=>$id_max
		));
	}
	//------------------------

	public function actionIntegrasiLsf()
	{
		$model=New IntegrasiForm;
		$connect= yii::app()->db;
               
		if (isset($_POST['IntegrasiForm'])){
			
			$model->attributes=$_POST['IntegariForm'];
			
			$model->date1= $_POST['IntegrasiForm']['date1'];
			$model->date2= $_POST['IntegrasiForm']['date2'];
			/*
			$sqlNol= "
				UPDATE engineattlsf
				SET status='I'
				WHERE 
				date(dateatt) between '$model->date1' AND '$model->date2'			
				AND time_to_sec(time(dateatt)) < time_to_sec('13:00:00')
				AND status= I
			";
			$sqlOne = "
				UPDATE engineatt
				SET status=1
				WHERE 
				date(dateatt) between '$model->date1' AND '$model->date2'			
				AND time_to_sec(time(dateatt)) >= time_to_sec('13:00:00')
				AND status= 0
			";
			*/
			//$connect->createCommand($sqlNol)->query();//Di off kan biar cepat
			//$connect->createCommand($sqlOne)->query();//Di off kan biar cepat
			$sql="
				SELECT  distinct (date(dateatt)) as tgl
				from engineattlsf
				WHERE date(dateatt) between '$model->date1' AND '$model->date2'				
			";
			$dtdate= $connect->createCommand($sql)->queryAll();

			foreach($dtdate as $ini){
				$dt[]= $ini['tgl'];//
				$sqlEmp="
					SELECT b.id, b.emp_id, a.name
					FROM cardlsf b, emp a
					WHERE a.id = b.emp_id
					";
				//looping employee	
				
				$rsEmp=$connect->createCommand($sqlEmp)->queryAll();
				$punchIn=NULL;
				$punchOut=NULL;
                                
				foreach ($rsEmp as$kEmp=>$vEmp)
				{
					$Attendance= New Attendance;
					
					$Attendance->date_job= $ini[tgl];
					$Attendance->emp_id= $vEmp[emp_id];	

					$sqlIn= "
					SELECT b.pin, b.status, b.dateatt, date(b.dateatt) as tgl, 
					a.id, a.name
					FROM emp a, engineattlsf b, cardlsf c 
					WHERE c.emp_id= a.id
					AND a.id= '$vEmp[emp_id]'
					AND b.pin= c.id 
					AND DATE(b.dateatt) ='$ini[tgl]'
					AND b.status='I'
					ORDER BY b.dateatt ASC
					LIMIT 1
					";
					$rsIn= $connect->createCommand($sqlIn)->query();
					$punchIn="";
					foreach($rsIn as $kIn=>$vIn){						
						if (empty($vIn[dateatt])){
							$punchIn="";
						}else {
							$punchIn= $vIn[dateatt];
						}
					}
					$sqlOut= "
					SELECT b.pin, b.status, b.dateatt, date(b.dateatt) as tgl, 
					a.id, a.name
					FROM emp a, engineattlsf b, cardlsf c 
					WHERE c.emp_id= a.id
					AND a.id= '$vEmp[emp_id]'
					AND b.pin= c.id
					AND DATE(b.dateatt) ='$ini[tgl]'
					AND b.status='O'
					ORDER BY b.dateatt Desc
					LIMIT 1
					";
					$rsOut= $connect->createCommand($sqlOut)->queryAll();
					//$result= $command->execute();
					$punchOut="";
					foreach ($rsOut as $kOut=>$vOut){
						if (empty($vOut[dateatt])){
							$punchOut="";
						}else {
							$punchOut=$vOut[dateatt];
						}
					}
					
					$sqlIgnore="
						REPLACE INTO attendance (date_job, emp_id, dt_in, dt_out) VALUES ('$ini[tgl]', '$vEmp[emp_id]', '$punchIn', '$punchOut');
					";
					yii::app()->db->createCommand($sqlIgnore)->query();
					//Yii::app()->db->createCommand()->insertIgnore('Attendance', array('date_job'=>$ini[tgl], 'emp_id'=>$vEmp[emp_id],
						//'dt_in'=>$vIn[dateatt], 'dt_out'=>$vOut[dateatt],
    				//)); 
    				$hakam[$i]['emp_id']=$vEmp[emp_id];
    				$hakam[$i]['name']=$vEmp['name'];
    				$hakam[$i]['in']=$punchIn;
    				$hakam[$i]['out']=$punchOut; 
    				$i++;  				
				}
				
			}

		}
		$this->render('integrasilsf', array('model'=>$model, 
                    'hkm'=>[$hakam], 
                    'dt'=>$dt));

	}

}

	
