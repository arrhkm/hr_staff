<?php 
class AttendanceForm extends CFormModel
{
	public $date1;
	public $date2;

	public function rules()
	{
		return array(
			array('date1, date2', 'required'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'date1'=>'Date start',
			'date2'=>'Date End',
		);
	}
}
?>