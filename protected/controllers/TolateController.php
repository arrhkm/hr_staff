<?php

class TolateController extends Controller
{
	public $layout='//layouts/column2';

	
	// Uncomment the following methods and override them if needed
	
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
				'actions'=>array('sendEmail2'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index', 'sendemail'),
				'expression'=>'$user->canAccess(0)',
				//'expression'=>'$user->isStaff()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index', 'sendemail'),
				'expression'=>'$user->isStaff()',
				//'expression'=>'$user->isStaff()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionIndex()
	{
		/*$dataProvider=new CActiveDataProvider('Emp');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
		*/
		$count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM tolate3')->queryScalar();
		$sql='SELECT * FROM tolate3';
		$dataProvider=new CSqlDataProvider($sql, array(
		    'totalItemCount'=>$count,
		    'sort'=>array(
		        'attributes'=>array(
		             'date_job', 'dt_in', 'dt_out', 'telat', 'name',
		        ),
		    ),
		    'pagination'=>array(
		        'pageSize'=>100,
		    ),
		));
		$dataProvider->getData();
		$this->render('index', array('dataProvider'=>$dataProvider));
	}

	public function actionSendEmail()
	{
		$sql= "
			SELECT a.*, time_to_sec(time(dt_in)) as jam, time_to_sec(c.must_in) as batas,  time_to_sec(time(a.dt_in)) - time_to_sec(time(c.must_in)) as v_telat,
			if (time_to_sec(time(a.dt_in)) > time_to_sec(c.must_in), true, false) as telat
			, b.name 
			FROM hr_staff.attendance as a 
			JOIN emp as b 
			ON (b.id= a.emp_id)
			JOIN officetime as c ON(c.id= b.officetime_id)
			WHERE a.date_job = curdate()
			AND if (time_to_sec(time(a.dt_in)) > time_to_sec(c.must_in), true, false) = true
			ORDER BY v_telat DESC
		";
		$model = yii::app()->db->createCommand($sql)->queryAll();
		$body .= "Berikut ini adalah karyawan yang datang terlambat disusun berdasarkan tingkat keterlambatan  Payroll HRD \nBatas Waktu MAKSIMAL tidak terlambat adalah 08:05:59 \n\n\n";
		foreach ($model as $data){
			$body .= " | Emp Id: " .  $data[emp_id]  ." | Name : ". $data[name] ." | tgl : ". $data[date_job] ." | IN : ". $data[dt_in] ." |  \n";
			$body .= "----------------------------------------------------------------------------------------------\n"; 
						
		}
		$body .= "\n\n\n Berikut ini Daftar tidak Masuk Ceklog hari ini : \n\n\n";
		$sql_notIn= "select a.*, b.name
			from attendance a, emp b
			WHERE  
			a.date_job = curdate()
			AND b.id= a.emp_id
			AND b.id NOT IN (SELECT emp_id FROM serviceout)
			AND b.id NOT IN (SELECT cuti_emp_id FROM detilcuti WHERE date_cuti = curdate())
			AND date(dt_in) = '0000-00-00'";
		$notIn = yii::app()->db->createCommand($sql_notIn)->queryAll();
		foreach ($notIn as $notIns){
			$body .= " | Emp Id: " .  $notIns[emp_id]  ." | Name : ". $notIns[name] ." | tgl : ". $notIns[date_job] ." | IN : ". $notIns[dt_in] ." |  \n";
			$body .= "----------------------------------------------------------------------------------------------\n"; 
		}
		$sql_cuti= "
			SELECT a.*, b.name as emp_name, c.name as cuti_name, d.des
			FROM detilcuti a, emp b, kodecuti c, cuti d
			WHERE a.date_cuti = curdate()
			AND b.id= a.cuti_emp_id
			AND c.id= a.kodecuti_id
			AND d.id= a.cuti_id
		";
		$dtCuti = yii::app()->db->createCommand($sql_cuti)->queryAll();
		$body .= "\n\n\n Berikut ini terdaftar cuti hari ini : \n\n\n";
		foreach ($dtCuti as $dtCutis){
			$body .= " | Emp Name: " .  $dtCutis[emp_name]  ." | Cuti : ". $dtCutis[cuti_name] ." | tgl : ". $dtCutis[date_cuti] ." | Keperluan : ". $dtCutis[des] ." |  \n";
			$body .= "----------------------------------------------------------------------------------------------\n"; 
		}
		$kirimi ='Payroll';
		//$mailTo = 'ichwan_hakim@lintech.co.id, andre@lintech.co.id, fendi@lintech.co.id, hakam@lintech.co.id, bondan@lintech.co.id, tita@lintech.co.id'; 
		//$mailTo = 'hakam@lintech.co.id, andre@lintech.co.id'; //test email kirim lintech
		$mailTo = 'staff_lintech@lintech.co.id';
		$subject = "ABSENSI PAYROLL STAFF (tolate in the day)";
		$headers = 'From: <'.$mailTo.'> ' . "\r\n" . 'Reply-To: ' . $mailTo;
		$headers = 'Form: <'.$kirimi.'> ' . "\r\n" . 'Reply-To: ' . $kirimi;
		mail($mailTo, $subject, $body, $headers);
		$this->redirect(array('tolate/index'));	
	}

	public function actionSendEmail2()
	{
		
		
		//$sql= "SELECT * FROM tolate";
		/*count(a.emp_id) as n_notelate, a.emp_id, b.name 			
			FROM hr_staff.attendance a, emp b , period c, officetime d
			WHERE c.id = $mPeriod->id
			AND a.date_job BETWEEN c.date_start AND c.date_end
			AND b.id= a.emp_id
			AND a.emp_id= '$emp_id'
			AND DAYOFWEEK(date(a.date_job)) not in (7,1)
			AND time(a.dt_in)<=d.must_in
			AND time(a.dt_out)>=d.must_out
			AND a.date_job not in (select id FROM dayoff WHERE period_id=c.id)
			AND d.id= b.officetime_id
		*/
		$sql= "
			SELECT a.*, time_to_sec(time(a.dt_in)) as jam, time_to_sec(c.must_in) as batas,  time_to_sec(time(a.dt_in)) - time_to_sec(time(c.must_in)) as v_telat,
			if (time_to_sec(time(a.dt_in)) > time_to_sec(c.must_in), true, false) as telat
			, b.name 
			FROM hr_staff.attendance as a 
			JOIN emp as b 
			ON (b.id= a.emp_id)
			JOIN officetime as c ON (c.id= b.officetime_id)
			WHERE a.date_job = curdate()
			AND if (time_to_sec(time(a.dt_in)) > time_to_sec(c.must_in), true, false) = true
			ORDER BY v_telat DESC
		";
		$model = yii::app()->db->createCommand($sql)->queryAll();
		$body .= "Berikut ini adalah karyawan yang datang terlambat disusun berdasarkan tingkat keterlambatan  Payroll HRD \nBatas Waktu MAKSIMAL tidak terlambat adalah 08:05:59 \n\n\n";
		foreach ($model as $data){
			$body .= " | Emp Id: " .  $data[emp_id]  ." | Name : ". $data[name] ." | tgl : ". $data[date_job] ." | IN : ". $data[dt_in] ." |  \n";
			$body .= "----------------------------------------------------------------------------------------------\n"; 
			
			/*$newTl= new Terlambat; //new terlambat
			$newTl->date_terlambat= $data[date_job];
			$newTl->emp_id= $data[emp_id];
			$newTl->name= $sata[name];
			$newTl->dt_in = $data[dt_in];
			$newTl->dt_out = $data[dt_out]; 
			$newTl->save();
			*/
			$sql= "REPLACE INTO terlambat VALUES
			( '$data[date_job]', '$data[emp_id]', '$data[name]', '$data[dt_in]', '$data[dt_out]', '$data[v_telat]')";
			yii::app()->db->createCommand($sql)->query();


		}
		$body .= "\n\n\n Berikut ini Daftar tidak Masuk Ceklog hari ini : \n\n\n";
		$sql_notIn= "select a.*, b.name
			from attendance a, emp b
			WHERE  
			a.date_job = curdate()
			AND b.id= a.emp_id
			AND b.id NOT IN (SELECT emp_id FROM serviceout WHERE status=1)
			AND date(dt_in) = '0000-00-00'";
		$notIn = yii::app()->db->createCommand($sql_notIn)->queryAll();
		foreach ($notIn as $notIns){
			$body .= " | Emp Id: " .  $notIns[emp_id]  ." | Name : ". $notIns[name] ." | tgl : ". $notIns[date_job] ." | IN : ". $notIns[dt_in] ." |  \n";
			$body .= "----------------------------------------------------------------------------------------------\n"; 
		}

		$kirimi ='Payroll';
		//$mailTo = 'ichwan_hakim@lintech.co.id, andre@lintech.co.id, fendi@lintech.co.id, hakam@lintech.co.id, bondan@lintech.co.id, tita@lintech.co.id'; 
		$mailTo = 'hakam@lintech.co.id'; //test email kirim lintech
		//$mailTo = 'staff_lintech@lintech.co.id';
		$subject = "ABSENSI PAYROLL STAFF (tolate in the day)";
		$headers = 'From: <'.$mailTo.'> ' . "\r\n" . 'Reply-To: ' . $mailTo;
		$headers = 'Form: <'.$kirimi.'> ' . "\r\n" . 'Reply-To: ' . $kirimi;
		mail($mailTo, $subject, $body, $headers);
		//$this->redirect(array('tolate/index'));	
	}


}