<?php

class KasbonController extends Controller
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
			),*/
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'index', 'view', 'update', 'create', 'deleteCicilan'),
				'expression'=>'$user->isPayroll()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'index', 'view', 'update', 'create', 'deleteCicilan'),
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
		$model = Kasbon::model()->with('emp')->findByPk($id);

		$critCicil= new CDbCriteria;
		$critCicil->condition= 'kasbon_id=:kasbon_id';
		$critCicil->params = array(':kasbon_id'=>$model->id);

		$mCicilan = New CActiveDataProvider('Cicilan', array(
					'criteria'=>$critCicil,
		));

		$sql= "SELECT SUM(value_cicil) FROM cicilan WHERE kasbon_id = $id";
		$sumCicilan= yii::app()->db->createCommand($sql)->queryScalar();
		$saldo = $model->kasbon_value-$sumCicilan;

		$this->render('view',array(
			'model'=>$model,
			'mCicilan'=>$mCicilan,
			'sumCicilan'=>$sumCicilan,
			'saldo'=>$saldo,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Kasbon;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Kasbon']))
		{
			$model->attributes=$_POST['Kasbon'];
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

		if(isset($_POST['Kasbon']))
		{
			$model->attributes=$_POST['Kasbon'];
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
		$mCicilan= Cicilan::model()->findByAttributes(array('kasbon_id'=>$id));
		if ($mCicilan){
			$mCicilan->delete();
		}
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
		$crt= New CDbCriteria;
		$crt->alias= 'a';
		$crt->select= 'a.*, b.name';
		$crt->join = "join emp as b ON(b.id= a.emp_id)";
		$crt->order = 'a.kasbon_date DESC';

		$dataProvider=new CActiveDataProvider('Kasbon', 
			array(
				'criteria'=>$crt,
				'pagination'=>array('pageSize'=>20),
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Kasbon('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Kasbon']))
			$model->attributes=$_GET['Kasbon'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionDeleteCicilan($id,$kasbon_id)
	{
		//$model= $this->loadModel($kasbon_id);
		$mCicilan= Cicilan::model()->findByPk($id);
		if ($mCicilan->delete())
		{
			//$this->redirect('view', array('id'=>$kasbon_id));
			if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view', 'id'=>$kasbon_id));
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Kasbon the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Kasbon::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Kasbon $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='kasbon-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
