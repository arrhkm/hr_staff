<?php

class DinasController extends Controller
{
	
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
			
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','view', 'create', 'update', 'delete', 'admin', 'tambah'),				
				'expression'=>'$user->isAdmin()',
				
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','view', 'create', 'update', 'delete', 'admin', 'tambah'),				
				'expression'=>'$user->isPayroll()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionTambah()
	{
	    $model=new OutareaHasEmp('dinasAdd');

	    // uncomment the following code to enable ajax-based validation
	    /*
	    if(isset($_POST['ajax']) && $_POST['ajax']==='outarea-has-emp-tambah-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	    */

	    if(isset($_POST['OutareaHasEmp']))
	    {
	       	$model->attributes=$_POST['OutareaHasEmp'];
	        if($model->validate())
	        {
	        	$pecah1 = explode("-", $model->date_start);
			    $date1 = $pecah1[2];
			    $month1 = $pecah1[1];
			    $year1 = $pecah1[0];

			   $selisih=$this->selisih($model->date_start, $model->date_end);
	           for($i=0;$i<=$selisih;$i++)
	            {
	            	$tanggal = mktime(0, 0, 0, $month1, $date1+$i, $year1);
	        		$tglstr = date("Y-m-d", $tanggal);
	        		$dtDate[$i]= $tglstr;
	        		$sqlIn= "
	        			INSERT IGNORE outarea_has_emp (emp_id, dateout, desout) VALUES ('$model->emp_id', '$tglstr', '$model->desout')
	        		";
	        		Yii::app()->db->createCommand($sqlIn)->query();
	            }
	            //$this->redirect()
	        }
	    }
	    $this->render('tambah',array(
	    	'model'=>$model, 
	    	'listEmp'=>$listEmp, 
	    	'selisih'=>$selisih,
	    	'dtDate'=>$dtDate
	    ));
	} 

	public function selisih($dateStart, $dateEnd)
	{

	    $pecah1 = explode("-", $dateStart);
	    $date1 = $pecah1[2];
	    $month1 = $pecah1[1];
	    $year1 = $pecah1[0];

	    // memecah string tanggal akhir untuk mendapatkan
	    // tanggal, bulan, tahun
	    $pecah2 = explode("-", $dateEnd);
	    $date2 = $pecah2[2];
	    $month2 = $pecah2[1];
	    $year2 =  $pecah2[0];

	    // mencari total selisih hari dari tanggal awal dan akhir
	    $jd1 = GregorianToJD($month1, $date1, $year1);
	    $jd2 = GregorianToJD($month2, $date2, $year2);

	    $selisih = $jd2 - $jd1;

	    // menghitung selisih hari yang bukan tanggal merah dan hari minggu
	    return ($selisih);
	}

	public function actionAdmin()
	{
		$dtku = array();
		$model=new OutareaHasEmp('search');
		
		$model->unsetAttributes();  // clear any default values
		if(isset($_POST['OutareaHasEmp']) OR isset($_GET['OutareaHasEmp']))
		{
			$model->attributes=$_GET['OutareaHasEmp'];
			
			if (isset($_POST['DeleteButton']))
			{

			 	if (isset($_POST['selectedIds']))			
        		{
	            	foreach ($_POST['selectedIds'] as $value)
		            {
		            		$id = explode(",", $value);
		            		$sqlDel = "DELETE FROM outarea_has_emp WHERE emp_id='$id[0]' AND dateout= '$id[1]'";
		            		yii::app()->db->createCommand($sqlDel)->query();
		            		
		            		/*
		            		foreach($_POST['selectedIds'] as $dt)	            
				            {
								$dataku[]= $dt;
							}*/
		            }
		       	}		      
            }     
        }
		
		
		$this->render('admin',array(
			'model'=>$model, 
			//'dt_id'=>$dataku,
			//'dt_id'=>$dt_tes,

		));
	}

	public function actionDelete($emp_id, $dateout)
	{
		$sqlDel = "DELETE FROM outarea_has_emp WHERE emp_id='$emp_id' AND dateout= '$dateout'";
		yii::app()->db->createCommand($sqlDel)->query();
		//$model= OutareaHasEmp::model()->findByAttributes(array('emp_id'=>$emp_id, 'dateout'=>$dateout));
		if (yii::app()->db->createCommand($sqlDel)->query()){
			$this->redirect(array('dinas/admin/'));
		}
		//$this->redirect('dinas/admin/');
	}

	



	
}