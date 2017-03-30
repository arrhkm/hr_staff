<?php

class CutiController extends Controller
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

	public function accessRules()
	{
		return array(			
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'index', 'view', 'create', 'update'),				
				'expression'=>'$user->isAdmin()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'index', 'view', 'create', 'update',),				
				'expression'=>'$user->isPayroll()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	public function actionIndex()
	{
		
		//a sample query but you could use more complex than it
		$sql = "SELECT a.*, b.name 
			FROM cuti a, emp b
			WHERE b.id= a.emp_id
			ORDER BY a.id DESC
		";		 
		$rawData = Yii::app()->db->createCommand($sql); //or use ->queryAll(); in CArrayDataProvider
		$count = Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar(); //the count
 
 
        $model = new CSqlDataProvider($rawData, array( //or $model=new CArrayDataProvider($rawData, array(... //using with querAll...
                    'keyField' => 'id', 
                    'totalItemCount' => $count, 
 
                    'sort' => array(
                        'attributes' => array(
                            'id','emp_id', 'name',  'des', 'accepted',
                        ),
                        'defaultOrder' => array(
                            'id' => CSort::SORT_ASC, //default sort value
                        ),
                    ),
                    'pagination' => array(
                        'pageSize' => 10,
                    ),
                ));
 
        $this->render('index', array(
            'model' => $model,
        ));
		
	}

	public function actionCreate()
{
    $model=new Cuti;

    // uncomment the following code to enable ajax-based validation
    /*
    if(isset($_POST['ajax']) && $_POST['ajax']==='cuti-cuti-form')
    {
        echo CActiveForm::validate($model);
        Yii::app()->end();
    }
    */

    if(isset($_POST['Cuti']))
    {
        $model->attributes=$_POST['Cuti'];
        if($model->validate())
        {
            $model->attributes= $_POST['cuti'];

            // form inputs are valid, do something here
            if ($model->save())
            {
            	$this->redirect(array('index'));
            }
        }
    }
    $this->render('create', array('model'=>$model));
}
public function actionDelete($id)
{
	$del1= yii::app()->db->createCommand("DELETE FROM detilcuti WHERE cuti_id=$id")->query();
	$del= yii::app()->db->createCommand("DELETE FROM cuti WHERE id =$id")->query();
	if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	/*if ($del){
		$this->redirect(array('index'));
	}*/
}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}