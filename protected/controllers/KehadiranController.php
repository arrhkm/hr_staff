<?php

class KehadiranController extends Controller
{
	
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	/*public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}*/

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','bydate', 'createcuti', 'sendmailku'),
				'expression'=>'$user->isAdmin()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	public function actionIndex()
	{
		$sql_telat= "
				SELECT a.*, time_to_sec(time(a.dt_in)) as jam, time_to_sec('08:05') as batas, 
				time_to_sec(time(a.dt_in))- time_to_sec(time('08:05')) as v_telat,
				if (time_to_sec(time(a.dt_in)) > time_to_sec('08:05'), true, false) as telat,
				if (a.dt_in ='0000-00-00', true, false) as absen
				,b.name 
				FROM hr_staff.attendance as a 
				JOIN emp as b 
				ON (b.id= a.emp_id)
				WHERE a.date_job BETWEEN date_add(curdate(), interval -1 Day) AND curdate()
				AND if (time_to_sec(time(dt_in)) > time_to_sec('08:05'), true, false) = true
				ORDER BY a.emp_id, a.date_job

		";

		$sql_telat2= "
				SELECT a.*, time_to_sec(time(a.dt_in)) as jam, time_to_sec('08:05') as batas, 
				time_to_sec(time(a.dt_in))- time_to_sec(time('08:05')) as v_telat,
				if (time_to_sec(time(a.dt_in)) > time_to_sec('08:05'), true, false) as telat,
				if (a.dt_in ='0000-00-00', true, false) as absen
				,b.name 
				FROM hr_staff.attendance as a 
				JOIN emp as b 
				ON (b.id= a.emp_id)
				WHERE a.date_job BETWEEN '2014-11-22' and '2014-12-21'
				AND if (time_to_sec(time(dt_in)) > time_to_sec('08:05'), true, false) = true
				ORDER BY a.emp_id, a.date_job

		";
		$telats= yii::app()->db->createCommand($sql_telat)->queryAll();
		foreach($telats as $telat)
		{
			
			//if ($telat['dt_in'] && $telat['dt_out'] != NULL){
				if (($telat['dt_in'])!= NULL){
					$sql_insert= "REPLACE INTO terlambat (date_terlambat, emp_id, name, dt_in, value_late) VALUES 
					('$telat[date_job]', '$telat[emp_id]', '$telat[name]', '$telat[dt_in]', 
					'$telat[v_telat]')";
					yii::app()->db->createCommand($sql_insert)->query();
				}
				if (($telat['dt_out'])!= NULL){
					$sql_insert= "REPLACE INTO terlambat (date_terlambat, emp_id, name, dt_out, value_late) VALUES
					( '$telat[date_job]', '$telat[emp_id]', '$telat[name]','$telat[dt_out]', 
					'$telat[v_telat]')";
					yii::app()->db->createCommand($sql_insert)->query();
				}
			//}
			/*
				$sql_insert= "REPLACE INTO terlambat VALUES
				( '$telat[date_job]', '$telat[emp_id]', '$telat[name]', '$telat[dt_in]', '$telat[dt_out]', 
				'$telat[v_telat]')";
			*/
			yii::app()->db->createCommand($sql_insert)->query();

		}		

		$this->render('index');
	}

	public function actionByDate()
	{
		$model= New AttendanceForm;
		$connect1 = yii::app()->db;
		if (isset($_POST['AttendanceForm']))
		{
			$model->attributes = $_POST['AttendanceForm'];			
			
		}
		$this->render('bydate', array(
			'model'=>$model, 			
		));
	}
	public function actionAbsen(){
		$sql= "
			SELECT a.*, b.name
			FROM attendance a, emp b
			WHERE  
			a.date_job = curdate()
			AND b.id= a.emp_id
			AND b.id NOT IN (SELECT emp_id FROM serviceout)
			AND b.id NOT IN (SELECT cuti_emp_id FROM detilcuti WHERE date_cuti = curdate())
			AND date(dt_in) = '0000-00-00'
		";
		$count= yii::app()->db->createCommand($sql_count)->queryScalar();			
			
		$dataProvider=new CSqlDataProvider($sql, array(
		    'totalItemCount'=>$count,
		    'sort'=>array(
		        'attributes'=>array(
		             'date_job', 'emp_id', 'name', 'dt_in',
		             'dt_out',
		             'v_telat', 'telat', 'absen'
		        ),
		    ),
		    'pagination'=>array(
		        'pageSize'=>10,
		    ),
		    
		));
		$this->render('absen', array('dataProvider'=>$dataProvider));
	}

	public function actionOnTime()
	{
		$sql_ontime="
			SELECT 
			count(a.emp_id), a.emp_id, b.name 			
			FROM hr_staff.attendance a, emp b , period c
			WHERE c.id = 1
			AND a.date_job BETWEEN c.date_start AND c.date_end
			AND b.id= a.emp_id
			AND a.emp_id= 'S09078'
			AND DAYOFWEEK(date(a.date_job)) not in (7,1)
			AND time(a.dt_in)<='08:05:59'
			AND time(a.dt_out)>='17:00:00'
			AND a.date_job not in (select id FROM dayoff WHERE period_id=c.id)			
		";
		$modelPeriod= Period::model()->findByPk(1);
		$selisih= $this->dateDiff($modelPeriod->date_start, $modelPeriod->date_end);
		$this->render('ontime', array('hari'=>$selisih));


	}

	public function actionSendmailku(){
		$to = 'hakam@lintech.co.id';
		$from = 'Hakam';
		$subject= 'Hallo apakabar';
		$message = 'Aku njajal message dulu ya';

		$this->mailsend($to, $from, $subject, $message);
		$this->redirect(array('index'));

	}

	public function mailsend($to,$from,$subject,$message){
        $mail=Yii::app()->smtpmail;
        $mail->SetFrom($from, 'From NAme');
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->AddAddress($to, "");
        if(!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }else {
            echo "Message sent!";
        }
    }

	public function pengurangan($x, $y){
		return $x-$y;
	}

	public function dateDiff($time1, $time2, $precision = 6)
	{
	    // If not numeric then convert texts to unix timestamps
	    if (!is_int($time1)) {
	      $time1 = strtotime($time1);
	    }
	    if (!is_int($time2)) {
	      $time2 = strtotime($time2);
	    }

	    // If time1 is bigger than time2
	    // Then swap time1 and time2
	    if ($time1 > $time2) {
	      $ttime = $time1;
	      $time1 = $time2;
	      $time2 = $ttime;
	    }

	    // Set up intervals and diffs arrays
	    $intervals = array('year','month','day','hour','minute','second');
	    $diffs = array();

	    // Loop thru all intervals
	    foreach ($intervals as $interval) {
	      // Set default diff to 0
	      $diffs[$interval] = 0;
	      // Create temp time from time1 and interval
	      $ttime = strtotime("+1 " . $interval, $time1);
	      // Loop until temp time is smaller than time2
	      while ($time2 >= $ttime) {
			$time1 = $ttime;
			$diffs[$interval]++;
			// Create new temp time from time1 and interval
			$ttime = strtotime("+1 " . $interval, $time1);
	      }
	    }

	    $count = 0;
	    $times = array();
	    // Loop thru all diffs
	    foreach ($diffs as $interval => $value) {
	      // Break if we have needed precission
	      if ($count >= $precision) {
			break;
	      }
	      // Add value and interval 
	      // if value is bigger than 0
	      if ($value > 0) {
			// Add s if value is not 1
			if ($value != 1) {
			 $interval .= "s";
			}
			// Add value and interval to times array
			$times[] = $value . " " . $interval;
			$count++;
	      }
	    }

	    // Return string with times
	    return implode(", ", $times);
	}

}