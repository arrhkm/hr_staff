<?php

/**
 * This is the model class for table "kasbon".
 *
 * The followings are the available columns in table 'kasbon':
 * @property integer $id
 * @property string $kasbon_date
 * @property string $kasbon_value
 * @property integer $kasbon_closing
 * @property string $emp_id
 *
 * The followings are the available model relations:
 * @property Cicilan[] $cicilans
 * @property Emp $emp
 */
class Kasbon extends CActiveRecord
{
	
	public $name;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kasbon';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, emp_id', 'required'),
			array('id, kasbon_closing', 'numerical', 'integerOnly'=>true),
			array('kasbon_value', 'length', 'max'=>10),
			array('emp_id', 'length', 'max'=>15),
			array('kasbon_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kasbon_date, kasbon_value, kasbon_closing, emp_id', 'safe', 'on'=>'search'),
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
			'cicilans' => array(self::HAS_MANY, 'Cicilan', 'kasbon_id'),
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
			'kasbon_date' => 'Kasbon Date',
			'kasbon_value' => 'Kasbon Value',
			'kasbon_closing' => 'Kasbon Closing',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('kasbon_date',$this->kasbon_date,true);
		$criteria->compare('kasbon_value',$this->kasbon_value,true);
		$criteria->compare('kasbon_closing',$this->kasbon_closing);
		$criteria->compare('emp_id',$this->emp_id,true);
		$criteria->order = 'kasbon_date DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Kasbon the static model class
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
