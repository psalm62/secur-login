<?php
/*
 * controller.php
 * 
 * Copyright 2017 -=RaM-= <psalm62@protonmail.com>
 * 
 * $dbA, $dbClobalKey, $dbGlobalIv - глобальные, продумать как избавиться от их глобализации...
 * 
 */

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
		if($page=='logout')
		{
			session_destroy();
			header('Location:./');
		}
		if(!(new access)->canAccess($page))
		{
			if($_SESSION['type'])
			{
				http_response_code(403);
				readfile('view/403.php');
				die();
			}
			else
			{
				//var_dump($_SESSION);
				header('Location: ./?page=login');
			}
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
			session_unset('count');
			$_SESSION['id']=$row['id'];
			$_SESSION['name']=$row['name'];
			$_SESSION['type']=$row['type'];			
			header("Location: ./?id={$_SESSION['id']}&page={$_SESSION['type']}");
		}
	}
	public function regUser()
	{
		global $dbA, $dbClobalKey, $dbGlobalIv;
		
		$login=filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
		$passw=filter_input(INPUT_POST, 'pass1', FILTER_SANITIZE_SPECIAL_CHARS);
		$fio=filter_input(INPUT_POST, 'fio', FILTER_SANITIZE_SPECIAL_CHARS);
		
		if(empty($login) || empty($passw) || empty($fio))
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
		$res=$model->regUser($c_login, $c_passw, $fio);
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
