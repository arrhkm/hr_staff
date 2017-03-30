<?php

/**
 * This is the model class for table "gajiempperiod".
 *
 * The followings are the available columns in table 'gajiempperiod':
 * @property string $emp_id
 * @property integer $period_id
 * @property string $gp
 * @property string $tmasakerja
 * @property string $tjabatan
 * @property string $tfungsional
 * @property string $tallowance
 * @property string $tpremihadir
 * @property string $tuangmakan
 * @property string $tdapen
 */
class Gajiempperiod extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gajiempperiod';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('emp_id, period_id', 'required'),
			array('period_id', 'numerical', 'integerOnly'=>true),
			array('emp_id', 'length', 'max'=>15),
			array('gp, tmasakerja, tjabatan, tfungsional, tallowance, tpremihadir, tuangmakan, tdapen', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('emp_id, period_id, gp, tmasakerja, tjabatan, tfungsional, tallowance, tpremihadir, tuangmakan, tdapen', 'safe', 'on'=>'search'),
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
			'emp_id' => 'Emp',
			'period_id' => 'Period',
			'gp' => 'Gp',
			'tmasakerja' => 'Tmasakerja',
			'tjabatan' => 'Tjabatan',
			'tfungsional' => 'Tfungsional',
			'tallowance' => 'Tallowance',
			'tpremihadir' => 'Tpremihadir',
			'tuangmakan' => 'Tuangmakan',
			'tdapen' => 'Tdapen',
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

		$criteria->compare('emp_id',$this->emp_id,true);
		$criteria->compare('period_id',$this->period_id);
		$criteria->compare('gp',$this->gp,true);
		$criteria->compare('tmasakerja',$this->tmasakerja,true);
		$criteria->compare('tjabatan',$this->tjabatan,true);
		$criteria->compare('tfungsional',$this->tfungsional,true);
		$criteria->compare('tallowance',$this->tallowance,true);
		$criteria->compare('tpremihadir',$this->tpremihadir,true);
		$criteria->compare('tuangmakan',$this->tuangmakan,true);
		$criteria->compare('tdapen',$this->tdapen,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Gajiempperiod the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
