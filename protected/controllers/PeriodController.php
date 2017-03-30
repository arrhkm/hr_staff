<?php

class PeriodController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			/*array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			*/
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index', 'view', 'create', 'update', 'admin','delete', 'payroll', 'latePeriod', 'emplate', 'sendmaillate', 'importGaji'),
				'expression'=>'$user->isPayroll()',
				
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index', 'view', 'create', 'update', 'admin','delete', 'payroll', 'latePeriod', 'emplate', 'sendmaillate', 'importGaji'),
				'expression'=>'$user->isAdmin()',
				
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$liburan= array();
		$model_dayoff = Dayoff::model()->findByAttributes(array('period_id'=>$id));
		$dtOff= Yii::app()->db->createCommand("Select id from dayoff WHERE period_id = $id")->queryAll();		
		foreach ($dtOff as $value){
			$liburan[]= $value['id'];			
		}
		 
         $crit= new CDbCriteria;
         $crit->select = '*';
         $crit->condition='period_id=:id';
         $crit->params = array(':id'=>$id);

         $dataProvider=new CActiveDataProvider('Dayoff', array(
		    //'criteria'=>$crit,
		    'criteria'=>array(
		    	'select'=>'*',
		        'condition'=>'period_id=:id',		        
		        'params' => array(':id'=>$id),
		        //'order'=>'id DESC',
		        //'with'=>array('author'),
    		),
		    'countCriteria'=>array(
		        'condition'=>'period_id=:id',
		        'params' => array(':id'=>$id),
		        // 'order' and 'with' clauses have no meaning for the count query
		   ),
	    	'pagination'=>array(
	        	'pageSize'=>20,
   			),
		));
        $model = $this->loadModel($id);            
		$this->render('view',array(
			'model'=>$model,
			'model2'=>$dataProvider,
			'hariKerja'=>$this->selisihHari($id),
			'dtOff'=>$dtOff,
			'dtMinggu'=>$this->cekMinggu($model->id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Period;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Period']))
		{
			$model->attributes=$_POST['Period'];
			$model->period_name= date('Y-M', strtotime($model->date_end));
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Period']))
		{
			$model->attributes=$_POST['Period'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$criteria= new CDbCriteria;
		$criteria->order= 'id DESC';
		$dataProvider=new CActiveDataProvider('Period', 
			array(
				'criteria'=>$criteria,
				'pagination'=>array('pageSize'=>10),
			)
		);
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Period('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Period']))
			$model->attributes=$_GET['Period'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionPayroll($period_id)
	{
		$mPeriod= Period::model()->findByPk($period_id);
		$dt= array();		
		$mEmp= Emp::model()->findAll();
		$i=0;
		foreach ($mEmp as $emp){
			$dt[$i]['period_id']=$period_id;			
			$dt[$i]['emp_id'] = $emp->id;
			$dt[$i]['name'] = $emp->name;
			$dt[$i]['telat'] = $this->getTelat($period_id, $emp->id)+ $this->getNotInOrOut($period_id, $emp->id);
			$dt[$i]['lupa_id'] = $this->getLupaId($period_id, $emp->id);
			$dt[$i]['notin_work']= $this->getNotinWork($period_id, $emp->id);
			$dt[$i]['cuti']= $this->getCuti($period_id, $emp->id);
			$dt[$i]['surat_dokter']= $this->getSuratDokter($period_id, $emp->id);
			$dt[$i]['permit']= $this->getPermit($period_id, $emp->id);
			$dt[$i]['jml'] = $this->getOntime($period_id, $emp->id);			
			$dt[$i]['dinas']=$this->getDinasLuar($period_id, $emp->id);	
			$dt[$i]['totalPremi']=$this->getOntime($period_id, $emp->id)+$this->getDinasLuar($period_id, $emp->id);	
			$dt[$i]['biayaPremi']=$emp->premi_hadir *($this->getOntime($period_id, $emp->id)+$this->getDinasLuar($period_id, $emp->id));
			$dt[$i]['gp']= $emp->gp;
			$dt[$i]['allowance']= $emp->allowance;
			$dt[$i]['tjabatan']=$emp->tjabatan;
			$dt[$i]['tmasakerja']=$emp->tmasakerja;
			$dt[$i]['tfunctional']=$emp->tfunctional;
			$dt[$i]['dapen']=$emp->dapen;

			$dt[$i]['kasbon']=$this->getKasbon($period_id, $emp->id);
			$dt[$i]['sisa_kasbon']=$this->getSisaKasbon($period_id, $emp->id);
			$dt[$i]['angsuran']=$this->getAngsuran($period_id, $emp->id);
			$dt[$i]['no_angsuran']=$this->getNoAngsuran($period_id, $emp->id);
			
			
			$i++;			
		}		
		$this->render('payroll', array('dt'=>$dt));
		
	}
	public function actionLatePeriod($periodId) //Generate keterlambatan Karyawan 
	{
		$mPeriod= $this->loadModel($periodId);
		$sqlLate= "
			SELECT a.emp_id, 
			b.name,
			count(*) as late_summary 
			FROM hr_staff.attendance as a 
			JOIN emp as b 
			ON (b.id= a.emp_id)
			JOIN officetime as c ON(c.id= b.officetime_id)
			WHERE a.date_job BETWEEN '$mPeriod->date_start' AND '$mPeriod->date_end'
			-- AND (time_to_sec(time(a.dt_in))> time_to_sec(c.must_in) OR time_to_sec(time(a.dt_out))< time_to_sec(c.must_out))
			AND DAYOFWEEK(a.date_job) not in (7,1)			
			AND ((time(a.dt_in) >c.must_in OR time(a.dt_out)<c.must_out)
			OR ( YEAR(a.dt_in)= 0  OR YEAR(a.dt_out) = 0) AND NOT(YEAR(a.dt_in) = 0	AND YEAR(a.dt_out) =0))
			AND a.emp_id not in (select permit_emp_id FROM permitdetil WHERE date_permit =a.date_job AND permitcode_id='IBA')
			AND a.date_job <> curdate()
			GROUP BY a.emp_id
		";
		$sql2= "
			SELECT count(*) 
			FROM hr_staff.attendance as a 
			JOIN emp as b 
			ON (b.id= a.emp_id)
			JOIN officetime as c ON(c.id= b.officetime_id)
			WHERE a.date_job BETWEEN '$mPeriod->date_start' AND '$mPeriod->date_end'
			-- AND (time_to_sec(time(a.dt_in))> time_to_sec(c.must_in) OR time_to_sec(time(a.dt_out))< time_to_sec(c.must_out))
			AND DAYOFWEEK(a.date_job) not in (7,1)
			AND ((time(a.dt_in) >c.must_in OR time(a.dt_out)<c.must_out)
				OR ( YEAR(a.dt_in)= 0  OR YEAR(a.dt_out) = 0) AND NOT(YEAR(a.dt_in) = 0	AND YEAR(a.dt_out) =0))
			AND a.emp_id not in (select permit_emp_id FROM permitdetil WHERE date_permit between '$mPeriod->date_start' AND '$mPeriod->date_end')
			AND a.date_job <> curdate()
		";

		$countLate= yii::app()->db->createCommand($sql2)->queryScalar();
		$dataProvider=new CSqlDataProvider($sqlLate, array(
			//'totalItemCount'=>$countLate,
			'pagination'=>array(
			'pageSize'=>100,
			),
		)
		);
		$dtLate= yii::app()->db->createCommand($sqlLate)->queryAll();
		foreach($dtLate as $dtLates)
		{
			if($dtLates[late_summary]>=5){
				$status=1;
			}
			else $status=0;
			$sql = "
				INSERT IGNORE emplate (period_id, emp_id, late_summary, status_late) VALUES 
				('$mPeriod->id', '$dtLates[emp_id]', $dtLates[late_summary], $status)
			";
			yii::app()->db->createCommand($sql)->query();
		}
		$sqlLateUpdate= "
			SELECT a.emp_id, 
			b.name,
			count(*) as late_summary 
			FROM hr_staff.attendance as a 
			JOIN emp as b 
			ON (b.id= a.emp_id)
			JOIN officetime as c ON(c.id= b.officetime_id)
			WHERE a.date_job BETWEEN '$mPeriod->date_start' AND '$mPeriod->date_end'
			AND DAYOFWEEK(a.date_job) not in (7,1)
			AND a.date_job not in (select id FROM dayoff WHERE period_id=$periodId)

			-- AND if (time_to_sec(time(a.dt_in)) > time_to_sec(c.must_in), true, false) = true
			-- AND a.emp_id not in (select permit_emp_id FROM permitdetil WHERE date_permit =a.date_job AND permitcode_id='IBA')
			AND ((time(a.dt_in) >c.must_in OR time(a.dt_out)<c.must_out)
				OR ( YEAR(a.dt_in)= 0  OR YEAR(a.dt_out) = 0) AND NOT(YEAR(a.dt_in) = 0	AND YEAR(a.dt_out) =0))
			AND a.emp_id not in (select permit_emp_id FROM permitdetil WHERE date_permit between '$mPeriod->date_start' AND '$mPeriod->date_end')
			-- AND a.emp_id IN (select emp_id FROM emplate WHERE period_id=$mPeriod->id)
			AND a.date_job <> curdate()
			GROUP BY a.emp_id
		";
		$dtLate2= yii::app()->db->createCommand($sqlLateUpdate)->queryAll();
		foreach($dtLate2 as $late2)
		{
			if($late2[late_summary]>=5){
				$status=1;
			}
			else {
				$status=0;
			}
			$sqlUpdate = "
				UPDATE emplate SET late_summary=$late2[late_summary] , status_late=$status 
				WHERE  period_id=$mPeriod->id  AND emp_id='$late2[emp_id]'
			";
			yii::app()->db->createCommand($sqlUpdate)->query();
		}
		$this->render('latePeriod', array('dataProvider'=>$dataProvider, 'id'=>$mPeriod->id));
	}

	

	public function actionEmpLate($periodId)
	{		
		 $crit= new CDbCriteria;
        // $crit->alias ='a';
         $crit->select = 'emplate.*, emp.name';
         $crit->join = 'JOIN emp ON(emp.id = emplate.emp_id AND emp.branch_id = 1)';
         $crit->condition= 'period_id=:id AND status_late=1 ';
         $crit->params = array(':id'=>$periodId);
        
         $sql= " 
         	SELECT a.*, b.name
			FROM emplate a, emp b 
			WHERE b.id= a.emp_id 
			AND b.branch_id= 1
			AND a.period_id= $periodId
			AND a.status_late=1
		";
		//$countLate= yii::app()->db->createCommand($sql2)->queryScalar();
		$dataProvider=new CSqlDataProvider($sql, array(
			//'totalItemCount'=>$countLate,
			'pagination'=>array(
			'pageSize'=>100,
			),
		)
		);

          /*$dataProvider=new CActiveDataProvider('Emplate', array(
		    'criteria'=>$crit,
		   
		    
		     'criteria'=>array(
		    	'alias'=>'a',
		    	'select'=>'a.*, b.name',
		    	'join'=>'JOIN emp as b ON(b.id=a.emp_id)',
		        'condition'=> 'period_id=:id AND status_late=1',		        
		        'params' => array(':id'=>$periodId),
		        //'order'=>'id DESC',
		        //'with'=>array('author'),
    		),
		    'countCriteria'=>array(
		       'condition'=> 'period_id=:id AND status_late=1',
		        'params' => array(':id'=>$periodId),
		        // 'order' and 'with' clauses have no meaning for the count query
		   ),
	    	'pagination'=>array(
	        	'pageSize'=>50,
   			),
   			
		));*/
        $model = $this->loadModel($periodId);            
		$this->render('emplate',array(
			'model'=>$model,
			'model2'=>$dataProvider,
			//'hariKerja'=>$this->selisihHari($id),
			//'dtOff'=>$dtOff,
			//'dtMinggu'=>$this->cekMinggu($model->id),
		)); 
	}
	public function actionSendMailLate($periodId)
	{
		$MPeriod= $this->loadModel($periodId);
		$sql= "
		SELECT a.*, b.name, b.email
		FROM emplate a, emp b
		WHERE b.id= a.emp_id
		AND b.branch_id = 1
		AND a.period_id= $periodId
		AND status_late=1
		AND (send_late is Null OR send_late <>1)
		";
		$dtLate= yii::app()->db->createCommand($sql)->queryAll();

		foreach ($dtLate as $Lates) {
			//$body .= " ";
			ob_start(); //Turn on output buffering
			?>	
								      EMAIL TEGURAN			

Peringatan ini ditujukan kepada:<?php echo "\n";?>

Nama		: <?php echo  $Lates['name']."\r\n";?>
NIP		: <?php echo $Lates['emp_id']."\r\n";?>
Periode		: <?php echo $MPeriod->period_name."\r\n";?>
Jumlah Telat: <?php echo $Lates['late_summary']."\r\n";?>

Surat Peringatan diterbitkan berdasarkan :
Bahwa Sdr. <?php echo $Lates[name];?> melakukan kesalahan berupa Indisiplin, terlambat masuk kerja minimal dari 5x 
dalam kurun waktu satu bulan.	
Sebagai seorang karyawan, Sdr. <?php  echo $Lates[name];?> seharusnya mampu menjaga tata tertib kerja dan bersedia untuk tiba 
dilokasi kerja pada waktu yang telah ditentukan sebagaimana yang telah tercantum dalam Surat Perjanjian Kerja (SPK).

EMAIL TEGURAN ini bertujuan memberitahukan bahwa SURAT TEGURAN akan segera dibuat oleh HRD dan akan diserahkan kepada 
yang bersangkutan. 

Demikian Email pemberitahuan ini dibuat, TERIMAKASIH.		
			<?php
			$message = ob_get_clean();
			$kirimi ='HRD Payroll';
			//$mailTo = 'ichwan_hakim@lintech.co.id, andre@lintech.co.id, fendi@lintech.co.id, hakam@lintech.co.id, bondan@lintech.co.id, tita@lintech.co.id'; 
			//$mailTo = 'hakam@lintech.co.id';
			$mailTo = $Lates['email']; //dikirim ke orang yang bersangkutan
			$subject = "SURAT TEGURAN";
			//$headers = 'From: <'.$mailTo.'> ' . "\r\n" . 'Reply-To: ' . $mailTo;
			//$headers = 'Form: <'.$kirimi.'> ' . "\r\n" . 'Reply-To: ' . $kirimi;
			$headers = 'Form: <'.$kirimi.'> ' . "\r\n" . 'Reply-To: ' . "\r\n". 'CC:ichwan_hakim@lintech.co.id, andre@lintech.co.id';
			mail($mailTo, $subject, $message, $headers);
		}

		foreach ($dtLate as $Lates) {
			$sqlUpdate="
				UPDATE emplate SET send_late= 1
				WHERE emp_id= '$Lates[emp_id]'
				AND period_id= $Lates[period_id]
				";
			Yii::app()->db->createCommand($sqlUpdate)->query();
		}

		$this->redirect(array('view', 'id'=>$periodId));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Period the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Period::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Period $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='period-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function selisihHari($periodId)
	{
	    // list tanggal merah selain hari minggu
	    //$tglLibur = Array("2013-01-04", "2013-01-05", "2013-01-17"); //Off kan jika $tglLibur sudah di set di function

	    // memecah string tanggal awal untuk mendapatkan
	    // tanggal, bulan, tahun
	    $liburan = array();
	    $mPeriod= $this->loadModel($periodId);
	    //$mDayOff = Dayoff::model()->findByAttributes(array('period_id'=>$id));
		$dtOff= Yii::app()->db->createCommand("Select id from dayoff WHERE period_id = $periodId")->queryAll();		
		foreach ($dtOff as $value){
			$liburan[]= $value['id'];			
		}


	    $pecah1 = explode("-", $mPeriod->date_start);
	    $date1 = $pecah1[2];
	    $month1 = $pecah1[1];
	    $year1 = $pecah1[0];

	    // memecah string tanggal akhir untuk mendapatkan
	    // tanggal, bulan, tahun
	    $pecah2 = explode("-", $mPeriod->date_end);
	    $date2 = $pecah2[2];
	    $month2 = $pecah2[1];
	    $year2 =  $pecah2[0];

	    // mencari total selisih hari dari tanggal awal dan akhir
	    $jd1 = GregorianToJD($month1, $date1, $year1);
	    $jd2 = GregorianToJD($month2, $date2, $year2);

	    $selisih = $jd2 - $jd1;

	    // proses menghitung tanggal merah dan hari minggu
	    // di antara tanggal awal dan akhir
	    for($i=0; $i<=$selisih; $i++)
	    {
	        // menentukan tanggal pada hari ke-i dari tanggal awal
	        $tanggal = mktime(0, 0, 0, $month1, $date1+$i, $year1);
	        $tglstr = date("Y-m-d", $tanggal);

	        // menghitung jumlah tanggal pada hari ke-i
	        // yang masuk dalam daftar tanggal merah selain minggu
	        
	        if (in_array($tglstr, $liburan))
	        {
	           $libur1++;
	        }

	        // menghitung jumlah tanggal pada hari ke-i
	        // yang merupakan hari minggu
	        //$libur2=0;
	        if ((date("N", $tanggal) == 6) OR ((date("N", $tanggal)==7)))
	        {
	           $libur2++;
	        }
	    }

	    // menghitung selisih hari yang bukan tanggal merah dan hari minggu
	    return ($selisih+1)-($libur1+$libur2);
	}
	public function cekMinggu($periodId)
	{
		$mPeriod= $this->loadModel($periodId);
		$pecah1 = explode("-", $mPeriod->date_start);
	    $date1 = $pecah1[2];
	    $month1 = $pecah1[1];
	    $year1 = $pecah1[0];

	    // memecah string tanggal akhir untuk mendapatkan
	    // tanggal, bulan, tahun
	    $pecah2 = explode("-", $mPeriod->date_end);
	    $date2 = $pecah2[2];
	    $month2 = $pecah2[1];
	    $year2 =  $pecah2[0];

	    // mencari total selisih hari dari tanggal awal dan akhir
	    $jd1 = GregorianToJD($month1, $date1, $year1);
	    $jd2 = GregorianToJD($month2, $date2, $year2);

	    $selisih = $jd2 - $jd1;

	    // proses menghitung tanggal merah dan hari minggu
	    // di antara tanggal awal dan akhir
	    for($i=0; $i<=$selisih; $i++)
	    {
	        // menentukan tanggal pada hari ke-i dari tanggal awal
	        $tanggal = mktime(0, 0, 0, $month1, $date1+$i, $year1);
	        $tglstr = date("Y-m-d", $tanggal);

	       
	        $num=0;
			if ((date("N", $tanggal) == 6) OR ((date("N", $tanggal)==7)))
		    {
		           $mingguArray[]= $tglstr;		         
		    }
		}
		return $mingguArray;
	}
	public function getKasbon($periodId, $emp_id)
	{
		$mPeriod= $this->loadModel($periodId);
		
		$sqlKasbon ="
		SELECT a.kasbon_value
		FROM kasbon a
		WHERE a.emp_id= '$emp_id'				
		AND a.kasbon_closing = false
		";
		
		$sqlKasbon2= "
		SELECT value FROM cashreceipt WHERE emp_id = '$emp_id' AND period_id = '$periodId'
		";
		$hasil1= yii::app()->db->createCommand($sqlKasbon2)->queryAll();
		
		foreach ($hasil1 as $kasbons){
			$nilai = $kasbons['value'];
		}
		return $nilai;		

	}
	public function getSisaKasbon($periodId, $emp_id)
	{
		$mPeriod= $this->loadModel($periodId);
		$sqlKasbon ="
		SELECT a.kasbon_value, a.kasbon_value - sum(b.value_cicil) as sisa_kasbon
		FROM kasbon a, cicilan b
		WHERE a.emp_id= '$emp_id'
		AND b.kasbon_id= a.id		
		AND a.kasbon_closing = false
		";
		$hasil1= yii::app()->db->createCommand($sqlKasbon)->queryAll();
		foreach ($hasil1 as $kasbons){
			$nilai = $kasbons['sisa_kasbon'];
		}
		return $nilai;	
	}

	public function getAngsuran($periodId, $emp_id)
	{
		$mPeriod= $this->loadModel($periodId);
		$sqlCicilan= "
		SELECT b.*
		FROM kasbon a, cicilan b
		WHERE a.emp_id= '$emp_id'
		AND b.kasbon_id= a.id
		AND b.date_cicil BETWEEN '$mPeriod->date_start' AND '$mPeriod->date_end'
		AND a.kasbon_closing = false
		";

		$hasil2= yii::app()->db->createCommand($sqlCicilan)->queryAll();
		foreach ($hasil2 as $cicil)
		{
			$nilai = $cicil['value_cicil'];
		}
		return $nilai;
	}

	public function getNoAngsuran($periodId, $emp_id)
	{
		$mPeriod= $this->loadModel($periodId);
		$sqlCicilan= "
		SELECT b.*
		FROM kasbon a, cicilan b
		WHERE a.emp_id= '$emp_id'
		AND b.kasbon_id= a.id
		AND b.date_cicil BETWEEN '$mPeriod->date_start' AND '$mPeriod->date_end'
		AND a.kasbon_closing = false
		";

		$hasil2= yii::app()->db->createCommand($sqlCicilan)->queryAll();
		foreach ($hasil2 as $cicil)
		{
			$nilai = $cicil['no_angsuran'];
		}
		return $nilai;
	}


	public function getDinasLuar($HPeriodId, $HEmpId)
	{
		$mPeriod= Period::model()->findByPk($HPeriodId);		
		$sqlDinas= "
			select *
			FROM outarea_has_emp
			WHERE emp_id = '$HEmpId'
			AND dateout BETWEEN '$mPeriod->date_start' AND '$mPeriod->date_end'
			AND DAYOFWEEK(dateout) not in (7,1)
			AND dateout not in (select id FROM dayoff WHERE period_id=$mPeriod->id)
		";
		$resultDInas= yii::app()->db->createCommand($sqlDinas)->queryAll();
		$n=0;
		foreach ( $resultDInas as $hasil){
			$n++;
		}
		return $n;
		
		//$mDinas = OutareaHasEmp::model()->findAllByAttributes(array('emp_id'=>$HEmpId, 'dateout'=>'BETWEEN $tgl1 AND $tgl2'));
		//return count($mDinas);
	}

	public function getOntime($period_id, $emp_id)
	{
		$mPeriod= $this->loadModel($period_id);
		$sql_ontime="
			SELECT 
			count(a.emp_id) as n_notelate, a.emp_id, b.name 			
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
		";
		$result = yii::app()->db->createCommand($sql_ontime)->queryScalar();
		if ($result) 
		{ 
			return $result; 
		} else {
			return 0;
		} 
	}

	public function getNotinWork($period_id, $emp_id)
	{
		$MPeriod= $this->loadModel($period_id);
		$sqlNotinWork = "
		SELECT COUNT(*)
		FROM hr_staff.attendance a, emp b 
		WHERE  a.date_job BETWEEN '$MPeriod->date_start' AND '$MPeriod->date_end'
		AND b.id = a.emp_id
		AND a.emp_id= '$emp_id'
		AND  DAYOFWEEK(a.date_job) not in (7, 1)
		AND a.date_job not in (SELECT id FROM dayoff WHERE period_id=$period_id)
		AND (date(a.dt_in)= '0000-00-00' AND date(a.dt_out) ='0000-00-00')
		AND a.date_job not in (SELECT  date_cuti 
			FROM detilcuti 
			WHERE cuti_emp_id='$emp_id'
			AND date_cuti BETWEEN '$MPeriod->date_start' AND '$MPeriod->date_end')
		AND a.date_job not in (SELECT date_permit	
			FROM permitdetil 
			WHERE permitcode_id = 'IDC' AND permit_emp_id= '$emp_id' 		
			AND date_permit BETWEEN '$MPeriod->date_start' AND '$MPeriod->date_end')
		AND a.date_job NOT IN (SELECT date_sick FROM suratdokter 
			WHERE date_sick BETWEEN '$MPeriod->date_start' AND '$MPeriod->date_end')

		";
		$result = yii::app()->db->createCommand($sqlNotinWork)->queryScalar();
		if ($result) 
		{ 
			return $result; 
		} else {
			return 0;
		} 


	}

	public function getTelat($period_id, $emp_id)
	{
		$MPeriod= $this->loadModel($period_id);
		$sql1= "
		SELECT COUNT(*)
		FROM attendance a, emp b, officetime c
		WHERE a.date_job BETWEEN '$MPeriod->date_start' AND '$MPeriod->date_end'
		AND b.id= a.emp_id 
		AND c.id= b.officetime_id
		AND a.emp_id= '$emp_id'		
		AND (time(a.dt_in) >c.must_in OR time(a.dt_out)<c.must_out)
		AND NOT(YEAR(a.dt_in) = 0  OR YEAR(a.dt_out) = 0)
		AND NOT(YEAR(a.dt_in) = 0	AND YEAR(a.dt_out) =0)
		AND DAYOFWEEK(a.date_job) not in (7,1)
		AND a.date_job not in (select id FROM dayoff WHERE period_id=$period_id)
		";		
		
		$telat= yii::app()->db->createCommand($sql1)->queryScalar();		
		return $telat;
	}

	public function getNotInOrOut($period_id, $emp_id)
	{
		$MPeriod= $this->loadModel($period_id);
		$sql1= "
		SELECT COUNT(*)
		FROM attendance a, emp b, officetime c
		WHERE a.date_job BETWEEN '$MPeriod->date_start' AND '$MPeriod->date_end'
		AND b.id= a.emp_id 
		AND c.id= b.officetime_id
		AND a.emp_id= '$emp_id'		
		-- AND (time(a.dt_in) is Null OR time(a.dt_out) is Null)
		AND ( YEAR(a.dt_in)= 0  OR YEAR(a.dt_out) = 0)
		AND NOT(YEAR(a.dt_in) = 0	AND YEAR(a.dt_out) =0)

		AND DAYOFWEEK(a.date_job) not in (7,1)
		AND a.date_job not in (select id FROM dayoff WHERE period_id=$period_id)
		";		
		
		$nilai= yii::app()->db->createCommand($sql1)->queryScalar();		
		return $nilai;

	}

	public function getLupaId($period_id, $emp_id)
	{
		$MPeriod= $this->loadModel($period_id);
		$sql2 ="
		SELECT COUNT(*)		
		FROM permitdetil 
		WHERE permitcode_id = 'IDC' AND permit_emp_id= '$emp_id' 
		AND date_permit BETWEEN '$MPeriod->date_start' AND '$MPeriod->date_end'
		";
		
		$lupa_idcard = yii::app()->db->createCommand($sql2)->queryScalar();
		return $lupa_idcard;
	}

	public function getCuti($period_id, $emp_id)
	{
		$MPeriod= $this->loadModel($period_id);

		$sql= "
		SELECT COUNT(*) 
		FROM detilcuti
		WHERE cuti_emp_id='$emp_id'
		AND date_cuti BETWEEN '$MPeriod->date_start' AND '$MPeriod->date_end'
		AND DAYOFWEEK(date_cuti) not in (7,1)
		AND date_cuti not in (select id FROM dayoff WHERE period_id=$period_id)
		";
		$nilai = yii::app()->db->createCommand($sql)->queryScalar();
		return $nilai;
	}


	public function getSuratDokter($period_id, $emp_id)
	{
		$MPeriod= $this->loadModel($period_id);
		$sql = "
		SELECT COUNT(*)
		FROM suratdokter 
		WHERE date_sick BETWEEN '$MPeriod->date_start' AND '$MPeriod->date_end'
		AND emp_id = '$emp_id'
		AND DAYOFWEEK(date_sick) not in (7,1)
		AND date_sick not in (select id FROM dayoff WHERE period_id=$period_id)
		";
		$nilai = yii::app()->db->createCommand($sql)->queryScalar();
		return $nilai;
	}
	public function getPermit($period_id, $emp_id)
	{
		$MPeriod= $this->loadModel($period_id);
		$sql = "
		SELECT COUNT(*) 
		FROM hr_staff.permitdetil
		WHERE date_permit BETWEEN '$MPeriod->date_start' AND '$MPeriod->date_end'
		AND permit_emp_id = '$emp_id'
		AND DAYOFWEEK(date_permit) not in (7,1)
		AND date_permit not in (select id FROM dayoff WHERE period_id=$period_id)
		";
		$nilai = yii::app()->db->createCommand($sql)->queryScalar();
		return $nilai;
	}
	
}
