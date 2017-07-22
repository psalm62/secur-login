<?php
/*
 * access.php
 * 
 * Copyright 2017 -=RaM=- <psalm62@protonmail.com>
 * 
 * 
 */

class access
{
	static $rights=array(
		'admin'=>array('admin'),
		'user'=>array('admin','user'),
		'logout'=>array('admin', 'user'),
		'reg'=>array(null),
		'login'=>array(null),
		'reclogin'=>array(null),
		'recpass'=>array(null),
		'vercode'=>array(null),
		'support'=>array(null,'user'),
		'newpass'=>array(null,'admin','user'),
		'newlogin'=>array('admin','user'),
		'newemail'=>array('admin','user'),
		'users_list'=>array('admin')
	);
	
	public function canAccess($type)
	{
		if($type===null || !array_key_exists($type, self::$rights))
		{
			return false;
		}
		if(in_array($_SESSION['type'], self::$rights[$type]))
		{
			return $this->fastTest($type);
		}
		else
		{
			return false;
		}
	}
	private function fastTest($type)
	{
		$type=trim($type);
		$type=basename($type);
		$filename=realpath("./controller/{$type}.php");
		$type='access'.$type;
		if(file_exists($filename))
		{
			require_once($filename);
			return (new $type)->canAccess();
		}
		else
		{
			return true;
		}
	}
}
?>

