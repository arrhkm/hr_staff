<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class IntegrasiForm extends CFormModel
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
        'date1'=> 'Date 1',
        'date2'=> 'Date 2', 
     );
   }
	
	
}
