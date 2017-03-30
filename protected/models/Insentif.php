
<?php

/**
 * This is the model class for table "insentif".
 *
 * The followings are the available columns in table 'insentif':
 * @property integer $id
 * @property string $value
 * @property string $description
 * @property integer $period_id
 * @property string $emp_id
 *
 * The followings are the available model relations:
 * @property Period $period
 * @property Emp $emp
 */
class Insentif extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	
	public $emp_name;
	public function tableName()
	{
		return 'insentif';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, period_id, emp_id', 'required'),
			array('id, period_id', 'numerical', 'integerOnly'=>true),
			array('value', 'length', 'max'=>10),
			array('description', 'length', 'max'=>50),
			array('emp_id', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, value, description, period_id, emp_id, emp_name', 'safe', 'on'=>'search'),
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
			'period' => array(self::BELONGS_TO, 'Period', 'period_id'),
			'emp' => array(self::BELONGS_TO, 'Emp', 'emp_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'value' => 'Value',
			'description' => 'Description',
			'period_id' => 'Period',
			'emp_id' => 'Emp',
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
		$criteria->select = 'a.*, b.name as emp_name';
		$criteria->join = 'JOIN emp as b ON (b.id= a.emp_id)';//tambahan
		$criteria->compare('a.id',$this->id);
		$criteria->compare('a.value',$this->value,true);
		$criteria->compare('a.description',$this->description,true);
		$criteria->compare('a.period_id',$this->period_id);
		$criteria->compare('a.emp_id',$this->emp_id,true);
		$criteria->compare('b.name',$this->emp_name,true);//tambahan
		$criteria->order='a.period_id AND a.id DESC';
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>200,
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Insentif the static model class
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
