<?php

/**
 * This is the model class for table "serviceout".
 *
 * The followings are the available columns in table 'serviceout':
 * @property integer $id
 * @property string $emp_id
 * @property string $name
 * @property string $date_start
 * @property string $date_end
 * @property string $note
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Emp $emp
 */
class Serviceout extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'serviceout';
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
			array('id, status', 'numerical', 'integerOnly'=>true),
			array('emp_id', 'length', 'max'=>15),
			array('name', 'length', 'max'=>45),
			array('note', 'length', 'max'=>100),
			array('date_start, date_end', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, emp_id, name, date_start, date_end, note, status', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'emp_id' => 'Emp',
			'name' => 'Name',
			'date_start' => 'Date Start',
			'date_end' => 'Date End',
			'note' => 'Note',
			'status' => 'Status',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('date_start',$this->date_start,true);
		$criteria->compare('date_end',$this->date_end,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function beforeValidate()
	{
		parent::beforeValidate();
	   	//$new_manager = new Manager();
	   	if($this->isNewRecord)
	   	{
	    	$criteria=new CDbCriteria;      //kita menggunakan criteria untuk mengetahui nomor terakhir dari database
	     	$criteria->select = 'id';   //yang ingin kita lihat adalah field "nilai1"
	     	$criteria->limit=1;             // kita hanya mengambil 1 buah nilai terakhir
		    $criteria->order='id DESC';  //yang dimbil nilai terakhir
		    $last = $this->find($criteria);
	     	if($last)   // jika ternyata ada nilai dalam data tersebut maka nilai nya saat ini tinggal di tambah 1 dari data sebelumya
	     	{
		       $newID = (int)$last->id+ 1;
		       //$newID = 'sabit-'.$newID;
	     	}
	     	else  //jika ternyata pada tabel terebut masih kosong, maka akan di input otomatis nilai "sabit-1" karena memang belum ada sebelumnya nilai lain
	     	{
	       		$newID = 1;
	     	}
	     	$this->id=$newID; // nilai1 di set nilai yang sudah di dapat tadi
	  	} 
	  	return true;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Serviceout the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}