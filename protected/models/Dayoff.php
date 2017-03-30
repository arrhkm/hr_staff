<?php

/**
 * This is the model class for table "dayoff".
 *
 * The followings are the available columns in table 'dayoff':
 * @property string $id
 * @property integer $period_id
 * @property string $name
 * @property string $describe_off
 *
 * The followings are the available model relations:
 * @property Period $period
 */
class Dayoff extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dayoff';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, period_id', 'required'),
			array('id', 'ECompositeUniqueValidator'),
			array('period_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			array('describe_off', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, period_id, name, describe_off', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Date Day Off',
			'period_id' => 'Period Day Off',
			'name' => 'Name / Nama Hari libur',
			'describe_off' => 'Describe Off/ Ketrangan ',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('period_id',$this->period_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('describe_off',$this->describe_off,true);
		$criteria->order = 'id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Dayoff the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/*public function beforeValidate(){
		parent::beforeValidate();
		if ($this->isNewRecord){
			$c=new CDbCriteria;
			$c->select= 'id';
			$c->order= 'id DESC';
			$c->limit = 1;
			$last= $this->find($c);
			if($last){
				$new_id = (int)$last->id+1;
			} else {
				$new_id = 1;
			}
			$this->id= $new_id;
		}
		return true;
	}
	*/
}
