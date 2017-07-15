<?php
/*
 * controller.php
 * 
 * Copyright 2017 -=RaM-= <whoram@protonmail.com>
 * 
 * $dbA, $dbClobalKey, $dbGlobalIv - глобальные, продумать как избавиться от их глобализации...
 * 
 */
session_start();

class controller
{
	private function makeView($page)
	{
		$page=trim($page);
		$page=basename($page);
		$filename=realpath("./view/{$page}.php");
		if (file_exists($filename))
		{
			require_once($filename);
			return new $page;
		}
		else
		{
			echo $filename;
			return null;
		}
	}
	public function display()
	{
		$page=filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS);
		if(empty($page) || $page=='login')
		{
			$page='login';
		}
		if(empty($page))
		{
			$page='login';
		}
		$view=$this->makeView($page);
		$view->content();
	}
	public function testLogin()
	{
		global $dbA, $dbClobalKey, $dbGlobalIv;
		
		$login=filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
		$passw=filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS);
		
		$c_login=openssl_encrypt($login, $dbA, $dbClobalKey, OPENSSL_RAW_DATA, $dbGlobalIv);
		
		$model=model::getInstance();
		$row=$model->testUser($c_login, $passw);
		
		if($row===false)
		{
			$_SESSION['count']=1;
			header('Location: ./?page=login');
			die();
		}
		else
		{
			session_destroy();
			echo "Здравствуйте <h2>$login</h2>";
			var_dump($_SESSION);
		}
	}
	public function regUser()
	{
		global $dbA, $dbClobalKey, $dbGlobalIv;
		
		$login=filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
		$passw=filter_input(INPUT_POST, 'pass1', FILTER_SANITIZE_SPECIAL_CHARS);
		
		if(empty($login) || empty($passw))
		{
			$_SESSION['count']=2;
			header('Location: ./?page=reg');
			die();
		}
		if($_POST['pass1']!=$_POST['pass2'])
		{
			$_SESSION['count']=3;
			header('Location: ./?page=reg');
			die();
		}
		
		$c_login=openssl_encrypt($login, $dbA, $dbClobalKey, OPENSSL_RAW_DATA, $dbGlobalIv);
		$c_passw=password_hash($passw, PASSWORD_BCRYPT, ['cost'=>12]);
		
		$model=model::getInstance();
		$res=$model->regUser($c_login, $c_passw);
		if($res!==false)
		{
			session_destroy();
			header('Location: ./?page=login');
		}
		else
		{
			echo "Не получилось зарегистрировать пользователя";
			die();
		}
	}
}
?>
