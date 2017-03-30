<?php

/**
 * This is the model class for table "officetime".
 *
 * The followings are the available columns in table 'officetime':
 * @property integer $id
 * @property string $name_time
 * @property string $must_in
 * @property string $must_out
 * @property string $limit_in_start
 * @property string $limit_in_last
 * @property string $limit_out_start
 * @property string $limit_out_last
 */
class Officetime extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'officetime';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('name_time', 'length', 'max'=>32),
			array('must_in, must_out, limit_in_start, limit_in_last, limit_out_start, limit_out_last', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name_time, must_in, must_out, limit_in_start, limit_in_last, limit_out_start, limit_out_last', 'safe', 'on'=>'search'),
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
			'name_time' => 'Name Time',
			'must_in' => 'Must In',
			'must_out' => 'Must Out',
			'limit_in_start' => 'Limit In Start',
			'limit_in_last' => 'Limit In Last',
			'limit_out_start' => 'Limit Out Start',
			'limit_out_last' => 'Limit Out Last',
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
		$criteria->compare('name_time',$this->name_time,true);
		$criteria->compare('must_in',$this->must_in,true);
		$criteria->compare('must_out',$this->must_out,true);
		$criteria->compare('limit_in_start',$this->limit_in_start,true);
		$criteria->compare('limit_in_last',$this->limit_in_last,true);
		$criteria->compare('limit_out_start',$this->limit_out_start,true);
		$criteria->compare('limit_out_last',$this->limit_out_last,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Officetime the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
