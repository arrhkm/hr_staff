
<?php

class UserIdentity extends CUserIdentity
{
   private $_id;
 	private $level;
	public function authenticate()
	{
		$username=strtolower($this->username);
		$user=User::model()->find('LOWER(user_name)=?',array($username));  // here I use Email as user name which comes from database
		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(!$user->validatePassword($this->password))
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else
		{
			//successfull
			
			$this->_id = $user->id;
			$this->username = $user->user_name;
			$this->level = $user->user_level;
			$this->setState('level', $user->user_level); //untuk memanggil level di database menggunakan EWebUser.php nanti
			$this->errorCode = self::ERROR_NONE;
			}
		return $this->errorCode == self::ERROR_NONE;
	}
	public function getId()       //  override Id
	{
	   return $this->_id;
	}
	
}
?>

