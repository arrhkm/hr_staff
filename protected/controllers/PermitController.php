<?php

class PermitController extends Controller
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
				'actions'=>array('admin','delete', 'index', 'view', 'create', 'update'),
				'expression'=>'$user->isAdmin()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'index', 'view', 'create', 'update'),
				'expression'=>'$user->isPayroll()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionIndex()
	{
		$sql = "
			SELECT a.*, b.name
			FROM permit a JOIN emp b ON (b.id= a.emp_id)
			ORDER BY id DESC
		";		 
		$rawData = Yii::app()->db->createCommand($sql); //or use ->queryAll(); in CArrayDataProvider
		$count = Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar(); //the count
 
 
        $model = new CSqlDataProvider($rawData, array( //or $model=new CArrayDataProvider($rawData, array(... //using with querAll...
                    'keyField' => 'id', 
                    'totalItemCount' => $count, 
 
                    'sort' => array(
                        'attributes' => array(
                            'id','emp_id', 'name',  'need', 'describe_need',
                        ),
                        'defaultOrder' => array(
                            'id' => CSort::SORT_DESC, //default sort value
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
	    $model=new Permit;
	    if(isset($_POST['Permit']))
	    {
	        $model->attributes=$_POST['Permit'];
	        if($model->validate())
	        {
	            
	            if($model->save()){
	            	$this->redirect(array('index'));
	            }
	        }
	    }
	    $this->render('create',array('model'=>$model));
	}

	public function actionDelete($id)
	{
		$del1= yii::app()->db->createCommand("DELETE FROM permitdetil WHERE permit_id=$id")->query();
		$del= yii::app()->db->createCommand("DELETE FROM permit WHERE id =$id")->query();
		if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		/*if ($del){
			$this->redirect(array('index'));
		}*/
	} 
}