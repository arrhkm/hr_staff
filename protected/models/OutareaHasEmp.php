<?php

/**
 * This is the model class for table "outarea_has_emp".
 *
 * The followings are the available columns in table 'outarea_has_emp':
 * @property integer $outarea_id
 * @property string $emp_id
 * @property string $dateout
 * @property string $desout
 *
 * The followings are the available model relations:
 * @property Emp $emp
 */
class OutareaHasEmp extends CActiveRecord
{
	public $selectedIds; // untuk fungsi delete selected
	public $date_start;
	public $date_end;
	public $emp_name;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'outarea_has_emp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('emp_id, date_start, date_end', 'required'),
			//array('numerical', 'integerOnly'=>true),
			array('emp_id', 'length', 'max'=>15),
			array('desout', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('emp_id, dateout, desout, emp_name', 'safe', 'on'=>'search'),
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
			
			'emp_id' => 'Emp',
			'dateout' => 'Dateout',
			'desout' => 'Keterangan Dinas',
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

		$criteria->alias='a';
		$criteria->select= 'a.emp_id, a.dateout, a.desout, b.name as emp_name';
		$criteria->join = " JOIN ". Emp::model()->tablename()." as b ON (b.id=a.emp_id) ";
		$criteria->order='a.dateout DESC';

		//$criteria->compare('outarea_id',$this->outarea_id);
		$criteria->compare('emp_id',$this->emp_id,true);
		$criteria->compare('dateout',$this->dateout,true);
		$criteria->compare('desout',$this->desout,true);
		$criteria->compare('b.name',$this->emp_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>30),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OutareaHasEmp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
