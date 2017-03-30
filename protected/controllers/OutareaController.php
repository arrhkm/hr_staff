<?php

class OutareaController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(
					'admin',
					'delete',
					'empdinas',
				),
				//'users'=>array('admin'),
				'expression'=>'$user->isPayroll()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(
					'admin',
					'delete',
					'empdinas',
				),
				//'users'=>array('admin'),
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
		$model=new Outarea;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Outarea']))
		{
			$model->attributes=$_POST['Outarea'];
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

		if(isset($_POST['Outarea']))
		{
			$model->attributes=$_POST['Outarea'];
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
		//$model2= OutareaHasEmp::model()->findByAttributes(array('outarea_id'=>$id));
		$sql1= "DELETE FROM outarea_has_emp WHERE outarea_id=$id";
		$hasil= Yii::app()->db->createCommand($sql1)->query();
		
		if ($hasil){
			$this->loadModel($id)->delete();
		}
		
		$sql2= "DELETE FROM outarea WHERE id = $id";
		//Yii::app()->db->createCommand($sql2)->query();


		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Outarea', array('criteria'=>array('order'=>'id DESC')));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Outarea('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Outarea']))
			$model->attributes=$_GET['Outarea'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionEmpdinas($id)
	{
		$model = new OutareaHasEmp;
		$connect= yii::app()->db;
		$modelOA= Outarea::model()->findByPk($id);
		$tgl= $modelOA->datearray;		
		if (isset($_POST['OutareaHasEmp'])){
			$model->attributes= $_POST['OutareaHasEmp'];
			$model->emp_id= $_POST['OutareaHasEmp']['emp_id'];
			$model->outarea_id= $modelOA->id;
			if ($tgl){
				$tgl2= explode(',', $tgl);
				foreach ($tgl2 as $tgls){
					$sql= "INSERT IGNORE outarea_has_emp (outarea_id, emp_id, dateout)
						VALUE (".$modelOA->id.", '".$model->emp_id."', '".$tgls."')
					";
					Yii::app()->db->createCommand($sql)->query();
				}
			}
			
			
		}
		

		$this->render('empdinas', array('model'=>$model, 'tgl'=>$tgl));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Outarea the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Outarea::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Outarea $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='outarea-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
