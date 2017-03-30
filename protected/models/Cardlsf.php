<?php

/**
 * This is the model class for table "cardlsf".
 *
 * The followings are the available columns in table 'cardlsf':
 * @property integer $id
 * @property string $emp_id
 * @property string $date_create
 * @property integer $sensorid
 */
class Cardlsf extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $name;
	public function tableName()
	{
		return 'cardlsf';
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
			array('id, sensorid', 'numerical', 'integerOnly'=>true),
			array('emp_id', 'length', 'max'=>15),
			array('date_create', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, emp_id, date_create, sensorid, name', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'emp_id' => 'Emp',
			'date_create' => 'Date Create',
			'sensorid' => 'Sensorid',
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
		$criteria->compare('emp_id',$this->emp_id,true);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('sensorid',$this->sensorid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function search2()
	{
		
		$criteria = new CDbCriteria;
		$criteria->alias = 'a';
		$criteria->select = 'a.id, a.emp_id, a.date_create, a.sensorid, b.name';
		$criteria->join = "join ".Emp::model()->tableName()." as b ON (b.id = a.emp_id)";

		$criteria->compare('id',$this->id);
		$criteria->compare('emp_id',$this->emp_id,true);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('sensorid',$this->sensorid);
		$criteria->compare('b.name',$this->name,true);

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
	 * @return Cardlsf the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
