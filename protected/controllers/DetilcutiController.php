<?php

class DetilcutiController extends Controller
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
			
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'index', 'view', 'create', 'update', 'detilcutiall'),
				'expression'=>'$user->isAdmin()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'index', 'view', 'create', 'update', 'detilcutiall'),
				'expression'=>'$user->isPayroll()',
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Detilcuti;


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Detilcuti']))
		{
			$model->attributes=$_POST['Detilcuti'];
			//if($model->save())
				//$this->redirect(array('cuti','id'=>$model->id));
			//$model->save();
			if($model->validate())
			{
				$pecah1 = explode("-", $model->dateStart);
				$date1 = $pecah1[2];
				$month1 = $pecah1[1];
				$year1 = $pecah1[0];

				$crt= new CDbCriteria;
				$crt->select='id';
				$crt->limit = 1;
				$crt->order= 'id DESC';

				$terakhir = Detilcuti::model()->find($crt);
				$idKu = (int)$terakhir->id+1;

				$selisih=$this->selisih($model->dateStart, $model->dateEnd);
		        for($i=0;$i<=$selisih;$i++)
		        {
	            	$tanggal = mktime(0, 0, 0, $month1, $date1+$i, $year1);
	        		$tglstr = date("Y-m-d", $tanggal);
	        		$dtDate[$i]= $tglstr;
	        		$sqlIn= "
	        			INSERT IGNORE detilcuti (id, cuti_id, cuti_emp_id, kodecuti_id, date_cuti) 
	        			VALUES ($idKu, $model->cuti_id, '$model->cuti_emp_id', $model->kodecuti_id, '$tglstr')
	        		";
	        		Yii::app()->db->createCommand($sqlIn)->query();
	        		
	        		$idKu++;
	        		$dtNum[$i]=$idKu;
		        }
		    }
		}

		$this->render('create',array(
			'model'=>$model,
			'dtDate'=>$dtDate,
			'dtNum'=>$dtNum,
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

		if(isset($_POST['Detilcuti']))
		{
			$model->attributes=$_POST['Detilcuti'];
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
		$dataProvider=new CActiveDataProvider('Detilcuti');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Detilcuti('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Detilcuti']))
			$model->attributes=$_GET['Detilcuti'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionDetilCutiAll()
	{
		$model=new Detilcuti('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Detilcuti']))
			$model->attributes=$_GET['Detilcuti'];

		$this->render('detilcutiall',array(
			'model'=>$model,
		));
	}

	public function actionDetil($id)
	{
		$model=new Detilcuti('search($id)');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Detilcuti']))
			$model->attributes=$_GET['Detilcuti'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Detilcuti the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Detilcuti::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Detilcuti $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='detilcuti-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
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
}
