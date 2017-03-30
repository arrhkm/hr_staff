<?php

/**
 * This is the model class for table "cicilan".
 *
 * The followings are the available columns in table 'cicilan':
 * @property integer $id
 * @property integer $no_angsuran
 * @property string $date_cicil
 * @property string $value_cicil
 * @property integer $kasbon_id
 * @property integer $period_id
 *
 * The followings are the available model relations:
 * @property Kasbon $kasbon
 * @property Period $period
 */
class Cicilan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cicilan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, kasbon_id', 'required'),
			array('id, no_angsuran, kasbon_id', 'numerical', 'integerOnly'=>true),
			array('value_cicil', 'length', 'max'=>10),
			array('date_cicil', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, no_angsuran, date_cicil, value_cicil, kasbon_id', 'safe', 'on'=>'search'),
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
			'kasbon' => array(self::BELONGS_TO, 'Kasbon', 'kasbon_id'),
			
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'no_angsuran' => 'No Angsuran',
			'date_cicil' => 'Date Cicil',
			'value_cicil' => 'Value Cicil',
			'kasbon_id' => 'Kasbon',
			
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
		$criteria->compare('no_angsuran',$this->no_angsuran);
		$criteria->compare('date_cicil',$this->date_cicil,true);
		$criteria->compare('value_cicil',$this->value_cicil,true);
		$criteria->compare('kasbon_id',$this->kasbon_id);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cicilan the static model class
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
