<?php

/**
 * This is the model class for table "cuti".
 *
 * The followings are the available columns in table 'cuti':
 * @property integer $id
 * @property string $emp_id
 * @property string $des
 * @property integer $accepted
 *
 * The followings are the available model relations:
 * @property Emp $emp
 * @property Detilcuti[] $detilcutis
 * @property Detilcuti[] $detilcutis1
 */
class Cuti extends CActiveRecord
{
	

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cuti';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, emp_id, des', 'required'),
			array('id, accepted', 'numerical', 'integerOnly'=>true),
			array('emp_id', 'length', 'max'=>15),
			array('des', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, emp_id, des, accepted', 'safe', 'on'=>'search'),
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
			'detilcutis' => array(self::HAS_MANY, 'Detilcuti', 'cuti_id'),
			'detilcutis1' => array(self::HAS_MANY, 'Detilcuti', 'cuti_emp_id'),
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
			'des' => 'Keperluan',
			'accepted' => 'Accepted',
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
		$criteria->compare('des',$this->des,true);
		$criteria->compare('accepted',$this->accepted);
		$criteria->order='id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cuti the static model class
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
