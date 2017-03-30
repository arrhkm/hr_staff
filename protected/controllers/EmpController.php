<?php

class EmpController extends Controller
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
			//array('allow',  // allow all users to perform 'index' and 'view' actions
				//'actions'=>array('index','view'),
				//'users'=>array('*'),
			//),
			//array('allow', // allow authenticated user to perform 'create' and 'update' actions
				//'actions'=>array('create','update'),
				//'users'=>array('@'),
			//),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index', 'view', 'create', 'update', 'admin','delete', 'createcuti', 'serviceout', 'deleteserviceout', 'addserviceOut'),
				'expression'=>'$user->isAdmin()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index', 'view', 'create', 'update', 'admin','delete', 'createcuti', 'serviceout', 'deleteserviceout', 'addserviceOut'),
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
		$model=new Emp;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Emp']))
		{
			$model->attributes=$_POST['Emp'];
			$model->gp= Convert::MoneyToNumber($model->gp);
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
		$model->gp= Convert::NumberToMoney($model->gp);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Emp']))
		{
			$model->attributes=$_POST['Emp'];
			$model->gp= Convert::MoneyToNumber($model->gp);
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
		//$sqlDelServ= "DELETE FROM"

		$sql_delserviceout= "DELETE FROM serviceout WHERE emp_id= '$id'";
		yii::app()->db->createCommand($sql_delserviceout)->query();

		$sql_delcard= "DELETE FROM card WHERE emp_id= '$id'";
		yii::app()->db->createCommand($sql_delcard)->query();

		$sql_delcuti= "DELETE FROM cuti WHERE emp_id= '$id'";
		yii::app()->db->createCommand($sql_delcuti)->query();

		$sql_delatt= "DELETE FROM attendance WHERE emp_id = '$id'";
		yii::app()->db->createCommand($sql_delatt)->query();

		$sql_delemp= "DELETE FROM emp WHERE id = '$id'";
		yii::app()->db->createCommand($sql_delemp)->query();

		//$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Emp');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Emp('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Emp']))
			$model->attributes=$_GET['Emp'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Emp the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Emp::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function actionCreateCuti($emp_id)
	{
	    $model=new Cuti('cuti');	    
	    $model->emp_id= $emp_id;
	    if(isset($_POST['Cuti']))
	    {
	        $model->attributes=$_POST['Cuti'];
	        if($model->validate())
	        {
	            $model->attributes= $_POST['cuti'];
	            //$model->emp_id= $emp_id;
	            if($model->save());
	            {
	            	$this->redirect(array('view', 'id'=>$emp_id));
	            }
	        }
	    }
	    $this->render('createcuti',array('model'=>$model));
	}

	public function actionServiceOut()
	{
		//a sample query but you could use more complex than it
		$sql = "
			SELECT * FROM serviceout
		";
		 
		$rawData = Yii::app()->db->createCommand($sql); //or use ->queryAll(); in CArrayDataProvider
		$count = Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar(); //the count
 
 
        $model = new CSqlDataProvider($rawData, array( //or $model=new CArrayDataProvider($rawData, array(... //using with querAll...
                    'keyField' => 'id', 
                    'totalItemCount' => $count,
 
                    //if the command above use PDO parameters
                    //'params'=>array(
                    //':param'=>$param,
                    //),
 
 
                    'sort' => array(
                        'attributes' => array(
                            'id','emp_id', 'name', 'note', 'status'
                        ),
                        'defaultOrder' => array(
                            'id' => CSort::SORT_ASC, //default sort value
                        ),
                    ),
                    'pagination' => array(
                        'pageSize' => 100,
                    ),
                ));
 
        $this->render('serviceout', array(
            'model' => $model,
        ));
	}
	public function actionDeleteServiceOut($id)
	{
		//$sql= "UPDATE serviceout SET status= 0 WHERE id= $id";
		$sql= "DELETE FROM serviceout WHERE id = $id";
		$del= yii::app()->db->createCOmmand($sql)->query();
		$this->redirect(array('serviceout'));
	}

	public function actionAddServiceOut()
	{
		$model = new Serviceout;
		if(isset($_POST['Serviceout']))
		{
			$model->attributes=$_POST['Serviceout'];
			if ($model->emp_id){
				$model_emp= Emp::model()->findByPk($model->emp_id);
				$model->name= $model_emp->name;
				$model->status= 1;
			}

			if($model->save()){
				$this->redirect(array('serviceout'));
			}
		}

		$this->render('addServiceOut',array(
			'model'=>$model,
			'model_emp'=>$model_emp->name,
		));
	}


	/**
	 * Performs the AJAX validation.
	 * @param Emp $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='emp-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
