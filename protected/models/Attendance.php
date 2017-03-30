<?php

/**
 * This is the model class for table "attendance".
 *
 * The followings are the available columns in table 'attendance':
 * @property string $date_job
 * @property string $emp_id
 * @property string $h_in
 * @property string $h_out
 * @property string $dt_in
 * @property string $dt_out
 *
 * The followings are the available model relations:
 * @property Emp $emp
 */
class Attendance extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'attendance';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_job, emp_id, dt_in, dt_out', 'required'),
			array('emp_id', 'length', 'max'=>15),
			array('h_in, h_out', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('date_job, emp_id, h_in, h_out, dt_in, dt_out', 'safe', 'on'=>'search'),
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
			'emp' => array(self::BELONGS_TO, 'Emp', 'emp_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'date_job' => 'Date Job',
			'emp_id' => 'Emp',
			'h_in' => 'H In',
			'h_out' => 'H Out',
			'dt_in' => 'Dt In',
			'dt_out' => 'Dt Out',
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

		$criteria->compare('date_job',$this->date_job,true);
		$criteria->compare('emp_id',$this->emp_id,true);
		$criteria->compare('h_in',$this->h_in,true);
		$criteria->compare('h_out',$this->h_out,true);
		$criteria->compare('dt_in',$this->dt_in,true);
		$criteria->compare('dt_out',$this->dt_out,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Attendance the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
