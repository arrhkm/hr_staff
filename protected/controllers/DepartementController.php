<?php

class DepartementController extends Controller
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
				'actions'=>array('index', 'view', 'update', 'create', 'admin','delete', 'partjob', 'deletepartjob', 'updatepartjob'),
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
		$model_detil = new Partjob;
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'model_detil'=> $model_detil,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Departement;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Departement']))
		{
			$model->attributes=$_POST['Departement'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	public function actionPartjob($id)
	{
		$model= new Partjob;
		$dep= Departement::model()->findByPk($id);
		if (isset($_POST['Partjob']))
		{
			$model->attributes=$_POST['Partjob'];
			$model->name= strtoupper($model->name);
			if ($model->save())
			{
				$this->redirect(array('view', 'id'=>$dep->id));
			}

		}
		$this->render('partjob', array(
			'model'=>$model,
			'dep'=>$dep,
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

		if(isset($_POST['Departement']))
		{
			$model->attributes=$_POST['Departement'];
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

	public function actionDeletePartjob($detil_id, $id)
	{
		if (isset($_REQUEST['detil_id']))
		{

			$sql_del = "DELETE FROM partjob WHERE id= '$_REQUEST[detil_id]'";
			$connect = yii::app()->db;
			$connect->createCommand($sql_del)->query();
		}
		//$model= Paertjob::model()->findByPk($_REQUEST['detil_id']);
		//$model->delete();
		//$test->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser		
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('departement', 'detil_id'=>$_REQUEST['detil_id']));
	}

	public function actionUpdatePartjob($detil_id, $id)	{
		
		$model=Partjob::model()->findByPk($detil_id);
		if(isset($_POST['Partjob']))
		{
			$model->attributes=$_POST['Partjob'];
			$model->departement_id=$id;
			$model->name= strtoupper($model->name);
			if($model->save())
			{
				$this->redirect(array('view','id'=>$id));
			}
		}
		$this->render('updatepartjob', array(
			'model'=>$model,   	

		));
	}


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Departement');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Departement('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Departement']))
			$model->attributes=$_GET['Departement'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Departement the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Departement::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Departement $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='departement-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
