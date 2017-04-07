<?php

/**
 * This is the model class for table "emp".
 *
 * The followings are the available columns in table 'emp':
 * @property string $id
 * @property string $name
 * @property string $gender
 * @property string $start_job
 * @property integer $warm_contract
 * @property string $warm_date
 * @property string $citizen_id
 * @property string $jamsostek_id
 * @property string $bank_account
 * @property string $npwp
 * @property string $gp
 * @property string $tmasakerja
 * @property string $tjabatan
 * @property string $tfunctional
 * @property string $allowance
 * @property string $premi_hadir
 * @property string $dapen
 * @property integer $stock_cuti
 * @property string $email
 * @property integer $partjob_id
 * @property integer $jobtitle_id
 * @property integer $officetime_id
 *
 * The followings are the available model relations:
 * @property Attendance[] $attendances
 * @property Cuti[] $cutis
 * @property Jobtitle $jobtitle
 * @property Partjob $partjob
 * @property Kasbon[] $kasbons
 * @property Manager[] $managers
 * @property OutareaHasEmp[] $outareaHasEmps
 * @property Overtime[] $overtimes
 * @property Payroll[] $payrolls
 * @property Permit[] $permits
 * @property Serviceout[] $serviceouts
 * @property ShiftOffice[] $shiftOffices
 * @property Suratdokter[] $suratdokters
 */
class Emp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'emp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, email', 'required'),
			array('warm_contract, non_aktif, stock_cuti, partjob_id, jobtitle_id, officetime_id, branch_id', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>15),
			array('name, jamsostek_id, bank_account, npwp, email', 'length', 'max'=>45),
			array('gender', 'length', 'max'=>1),
			array('citizen_id', 'length', 'max'=>19),
			array('gp, tmasakerja, tjabatan, tfunctional, premi_hadir, uang_makan, dapen', 'length', 'max'=>12),
			array('allowance', 'length', 'max'=>12),
			array('start_job, warm_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, gender, start_job, warm_contract, warm_date, citizen_id, jamsostek_id, bank_account, npwp, gp, tmasakerja, tjabatan, tfunctional, allowance, premi_hadir, dapen, stock_cuti, email, partjob_id, jobtitle_id, officetime_id, branch_id', 'safe', 'on'=>'search'),
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
			'attendances' => array(self::HAS_MANY, 'Attendance', 'emp_id'),
			'cutis' => array(self::HAS_MANY, 'Cuti', 'emp_id'),
			'jobtitle' => array(self::BELONGS_TO, 'Jobtitle', 'jobtitle_id'),
			'partjob' => array(self::BELONGS_TO, 'Partjob', 'partjob_id'),
			'kasbons' => array(self::HAS_MANY, 'Kasbon', 'emp_id'),
			'managers' => array(self::HAS_MANY, 'Manager', 'emp_id'),
			'outareaHasEmps' => array(self::HAS_MANY, 'OutareaHasEmp', 'emp_id'),
			'overtimes' => array(self::HAS_MANY, 'Overtime', 'emp_id'),
			'payrolls' => array(self::HAS_MANY, 'Payroll', 'emp_id'),
			'permits' => array(self::HAS_MANY, 'Permit', 'emp_id'),
			'serviceouts' => array(self::HAS_MANY, 'Serviceout', 'emp_id'),
			'shiftOffices' => array(self::HAS_MANY, 'ShiftOffice', 'emp_id'),
			'suratdokters' => array(self::HAS_MANY, 'Suratdokter', 'emp_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'gender' => 'Gender',
			'start_job' => 'Start Job',
			'warm_contract' => 'Warm Contract',
			'warm_date' => 'Warm Date',
			'citizen_id' => 'Citizen',
			'jamsostek_id' => 'Jamsostek',
			'bank_account' => 'Bank Account',
			'npwp' => 'Npwp',
			'gp' => 'Gp',
			'tmasakerja' => 'Tmasakerja',
			'tjabatan' => 'Tjabatan',
			'tfunctional' => 'Tfunctional',
			'allowance' => 'Allowance',
			'premi_hadir' => 'Premi Hadir',
			'uang_makan' => 'Uang Makan',
			'dapen' => 'Dapen',
			'stock_cuti' => 'Stock Cuti',
			'email' => 'Email',
			'partjob_id' => 'Partjob',
			'jobtitle_id' => 'Jobtitle',
			'officetime_id' => 'Officetime',
			'non_aktif' => 'Non Aktif',
			'branch_id'=>'Branch ID'
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('start_job',$this->start_job,true);
		$criteria->compare('warm_contract',$this->warm_contract);
		$criteria->compare('warm_date',$this->warm_date,true);
		$criteria->compare('citizen_id',$this->citizen_id,true);
		$criteria->compare('jamsostek_id',$this->jamsostek_id,true);
		$criteria->compare('bank_account',$this->bank_account,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('gp',$this->gp,true);
		$criteria->compare('tmasakerja',$this->tmasakerja,true);
		$criteria->compare('tjabatan',$this->tjabatan,true);
		$criteria->compare('tfunctional',$this->tfunctional,true);
		$criteria->compare('allowance',$this->allowance,true);
		$criteria->compare('premi_hadir',$this->premi_hadir,true);
		$criteria->compare('uang_makan',$this->uang_makan,true);
		$criteria->compare('dapen',$this->dapen,true);
		$criteria->compare('stock_cuti',$this->stock_cuti);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('partjob_id',$this->partjob_id);
		$criteria->compare('jobtitle_id',$this->jobtitle_id);
		$criteria->compare('officetime_id',$this->officetime_id);
		$criteria->compare('non_aktif',$this->non_aktif);
		$criteria->compare('branch_id',$this->branch_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>300),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Emp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/*
	public function relations()
    {
        return array(
           
            'periods'=>array(self::MANY_MANY, 'Period',
                'Gajiempperiod(emp_id, period_id)'),
        );
    }
    */
}
