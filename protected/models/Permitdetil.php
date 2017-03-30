<?php

/**
 * This is the model class for table "permitdetil".
 *
 * The followings are the available columns in table 'permitdetil':
 * @property integer $id
 * @property string $date_permit
 * @property integer $permit_id
 * @property string $permit_emp_id
 * @property string $permitcode_id
 *
 * The followings are the available model relations:
 * @property Permit $permit
 * @property Permit $permitEmp
 * @property Permitcode $permitcode
 */
class Permitdetil extends CActiveRecord
{
	
	//tambahan sendiri 
	public $name;
	public $codename;
	//public function tableName()
	//{
		//return 'emp';
	//}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'permitdetil';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, permit_id, permit_emp_id, permitcode_id, date_permit', 'required'),
			array('permit_id, permit_emp_id, date_permit', 'ECompositeUniqueValidator'),
			array('id, permit_id', 'numerical', 'integerOnly'=>true),
			array('permit_emp_id', 'length', 'max'=>15),
			array('permitcode_id', 'length', 'max'=>5),
			array('date_permit', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, date_permit, permit_id, permit_emp_id, permitcode_id, name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'permit' => array(self::BELONGS_TO, 'Permit', 'permit_id'),
			'permitEmp' => array(self::BELONGS_TO, 'Permit', 'permit_emp_id'),
			'permitcode' => array(self::BELONGS_TO, 'Permitcode', 'permitcode_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'date_permit' => 'Date Permit',
			'permit_id' => 'Permit',
			'permit_emp_id' => 'Permit Emp',
			'permitcode_id' => 'Permitcode',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->alias = 'a';
		$criteria->select= 'a.id, a.date_permit, a.permit_id, a.permit_emp_id, a.permitcode_id,  b.name, c.name as codename';
		$criteria->join = " JOIN ". Emp::model()->tablename()." as b ON (b.id=a.permit_emp_id) JOIN ". Permitcode::model()->tableName().
		" as c ON (c.id= a.permitcode_id)";

		$criteria->compare('id',$this->id);
		$criteria->compare('date_permit',$this->date_permit,true);
		$criteria->compare('permit_id',$this->permit_id);
		$criteria->compare('permit_emp_id',$this->permit_emp_id,true);
		$criteria->compare('permitcode_id',$this->permitcode_id,true);

		$criteria->compare('b.name',$this->name,true);
		$criteria->order='a.date_permit DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=>10,
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Permitdetil the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function beforeValidate()// Auto Increment Manual buatan sendiri
	{
		parent::beforeValidate();
		
		if ($this->isNewRecord)
		{
			$ctr = new CDbCriteria;
			$ctr->select = 'id';
			$ctr->order= 'id DESC';
			$ctr->limit= 1;
			$last= $this->find($ctr);
			if($last)
			{
				$new_id = (int)$last->id+1;
			}
			else { $new_id = 1;}
			$this->id= $new_id;
		}
		return true;
	}
}
