<?php

class CashreceiptController extends Controller
{
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
				'actions'=>array('index', 'view', 'admin','delete', 'create', 'update'),				
				'expression'=>'$user->isPayroll()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','view','admin','delete', 'create', 'update'),								
				'expression'=>'$user->isAdmin()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionCreate()
	{
		$model=new Cashreceipt;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Cashreceipt']))
		{
			$model->attributes=$_POST['Cashreceipt'];
			$model->value= Convert::MoneyToNumber($_POST['Cashreceipt']['value']);
			if($model->save())
				//$this->redirect(array('view','id'=>$model->id));
				$this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionAdmin()
	{
	    $model=new Cashreceipt('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Cashreceipt']))
		{
			$model->attributes=$_GET['Cashreceipt'];
		}	  

		$this->render('admin',array(
			'model'=>$model,
		));	   
	} 

	public function actionUpdate($id1, $id2)
	{
		$model=$this->loadModel($id1, $id2);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Cashreceipt']))
		{
			$model->attributes=$_POST['Cashreceipt'];
			$model->value= Convert::MoneyToNumber($_POST['Cashreceipt']['value']);
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id1, $id2)
	{
		$this->loadModel($id1, $id2)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function loadModel($id1, $id2)
	{
		$model=Cashreceipt::model()->findByAttributes(array('emp_id'=>$id1, 'period_id'=>$id2));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Cardlsf $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cardlsf-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
}