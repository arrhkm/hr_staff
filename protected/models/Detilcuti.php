<?php

/**
 * This is the model class for table "detilcuti".
 *
 * The followings are the available columns in table 'detilcuti':
 * @property integer $id
 * @property integer $cuti_id
 * @property string $cuti_emp_id
 * @property integer $kodecuti_id
 * @property string $date_cuti
 *
 * The followings are the available model relations:
 * @property Cuti $cuti
 * @property Cuti $cutiEmp
 * @property Kodecuti $kodecuti
 */
class Detilcuti extends CActiveRecord
{
	public $emp_id;
	public $dateStart;
	public $dateEnd, $cuti_name, $emp_name;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'detilcuti';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, cuti_id, cuti_emp_id, kodecuti_id, dateStart, dateEnd', 'required'),
			array('cuti_emp_id, date_cuti', 'ECompositeUniqueValidator'),
			array('id, cuti_id, kodecuti_id', 'numerical', 'integerOnly'=>true),
			array('cuti_emp_id', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cuti_id, cuti_emp_id, kodecuti_id, date_cuti, emp_name', 'safe', 'on'=>'search'),
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
			'cuti' => array(self::BELONGS_TO, 'Cuti', 'cuti_id'),
			'cutiEmp' => array(self::BELONGS_TO, 'Cuti', 'cuti_emp_id'),
			'kodecuti' => array(self::BELONGS_TO, 'Kodecuti', 'kodecuti_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cuti_id' => 'Cuti',
			'cuti_emp_id' => 'Cuti Emp',
			'kodecuti_id' => 'Kodecuti',
			'date_cuti' => 'Date Cuti',
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
		$criteria->compare('a.id',$this->id);
		$criteria->compare('a.cuti_id',$this->cuti_id);
		$criteria->compare('a.cuti_emp_id',$this->cuti_emp_id,true);
		$criteria->compare('a.kodecuti_id',$this->kodecuti_id);
		$criteria->compare('a.date_cuti',$this->date_cuti,true);
		$criteria->compare('c.name',$this->emp_name,true);
		$criteria->select = 'a.*, b.name as cuti_name, c.name as emp_name';  
		$criteria->join = 'JOIN kodecuti b ON (b.id= a.kodecuti_id) JOIN emp c ON (c.id= a.cuti_emp_id)';
		$criteria->order = 'a.date_cuti DESC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function detil($emp_id)
	{
		$criteria= new CDbCriteria;
		$criteria->alias = 'a';
		$criteria->compare('a.id',$this->id);
		$criteria->compare('a.cuti_id',$this->cuti_id);
		$criteria->compare('a.cuti_emp_id',$this->cuti_emp_id,true);
		$criteria->compare('a.kodecuti_id',$this->kodecuti_id);
		$criteria->compare('a.date_cuti',$this->date_cuti,true);
		$criteria->compare('c.name',$this->emp_name,true);
		$criteria->select = 'a.*, b.name as cuti_name, c.name as emp_name';  
		$criteria->join = 'JOIN kodecuti b ON (b.id= a.kodecuti_id) JOIN emp c ON (c.id= a.cuti_emp_id)';
		$criteria->order = 'a.date_cuti DESC';
		//$criteria->condition= 'cuti_emp_id= 1';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>50),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Detilcuti the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function beforeValidate()
	{
		parent::beforeValidate();
		if ($this->isNewRecord)
		{
			$criteria = New CDbCriteria;
			$criteria->select = 'id';			
			$criteria->order= 'id DESC';
			$criteria->limit= 1;
			$last = $this->find($criteria);
			if($last)
			{
				$NEW_ID = (int)$last->id+1;
			}
			else {
				$NEW_ID= 1;
			}
			$this->id= $NEW_ID;
		}
		return true;
	}

}
