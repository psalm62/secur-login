<?php
/*
 * controller.php
 * 
 * Copyright 2017 -=RaM-= <psalm62@protonmail.com>
 * 
 * 
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
			//$_SESSION['count']=1;
			header('Location: ./?page=login&info=error');
			die();
		}
		else
		{
			session_unset('count');
			$_SESSION['id']=$row['id'];
			//$_SESSION['email']=$row['email'];
			$_SESSION['type']=$row['type'];			

			header("Location: ./?page={$_SESSION['type']}");
		}
	}
	public function regUser()
	{
		global $dbA, $dbClobalKey, $dbGlobalIv;
		
		$login=filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
		$passw=filter_input(INPUT_POST, 'pass1', FILTER_SANITIZE_SPECIAL_CHARS);
		$email=filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
		
		if(empty($login) || empty($passw) || empty($email))
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
		$c_email=openssl_encrypt($email, $dbA, $dbClobalKey, OPENSSL_RAW_DATA, $dbGlobalIv);
		$c_passw=password_hash($passw, PASSWORD_BCRYPT, ['cost'=>12]);
		$ivsize=openssl_cipher_iv_length($dbA);
		$iv=openssl_random_pseudo_bytes($ivsize);
		
		
		$model=model::getInstance();
		$res=$model->regUser($c_login, $c_passw, $c_email, $iv);
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
	public function recLogin()
	{
		global $dbA, $dbClobalKey, $dbGlobalIv;
		
		$email=filter_input(INPUT_POST, 'remail', FILTER_VALIDATE_EMAIL);
		$c_email=openssl_encrypt($email, $dbA, $dbClobalKey, OPENSSL_RAW_DATA, $dbGlobalIv);
		
		$model=model::getInstance();
		$row=$model->getLogin($c_email);
		if($row['login'])
		{
			$login=openssl_decrypt($row['login'], $dbA, $dbClobalKey, OPENSSL_RAW_DATA, $dbGlobalIv);
			//mail("$email", "My Subject", "$login"); 
			header('Location: ./?page=login&info=1');
		}
		else
		{
			header('Location: ./?page=reclogin&info=error');
			die();
		}
	}
	public function getCode()
	{
		global $dbA, $dbClobalKey, $dbGlobalIv;
		
		$login=filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
		$c_login=openssl_encrypt($login, $dbA, $dbClobalKey, OPENSSL_RAW_DATA, $dbGlobalIv);

		$model=model::getInstance();
		$row=$model->getEmailForSendCode($c_login);
		if($row['email'])
		{
			$email=openssl_decrypt($row['email'], $dbA, $dbClobalKey, OPENSSL_RAW_DATA, $dbGlobalIv);
			$bytes = random_bytes(3);
			$hex   = bin2hex($bytes);
			$res=$model->writeCodeBase($hex, $c_login);
			if($res!==false)
			{
				//mail("$email", "My Subject", "$hex"); 
				header("Location: ./?page=vercode&cd={$hex}");
				//header("Location: ./?page=recode");
			}
			else
			{
				echo "Ошибка! Не удалось...";
				die();
			}
			
		}
		else
		{
			header('Location: ./?page=recpass&info=error');
		}
	}
	public function verifyCod()
	{

		$code=filter_input(INPUT_POST, 'cod', FILTER_SANITIZE_SPECIAL_CHARS);
		
		$model=model::getInstance();
		$row=$model->getLoginOnCode($code);
		
		if($row)
		{
			$_SESSION['login']=$row['login'];
			header('Location: ./?page=newpass');
		}
		else
		{
			header('Location: ./?page=vercode&info=error');
			die();
		}
	}
	public function newPassword()
	{
		
		if($_POST['pass1']!==$_POST['pass2'])
		{
			header('Location: ./?page=newpass&info=error');
			die();
		}
		
		$pass=filter_input(INPUT_POST, 'pass1', FILTER_SANITIZE_SPECIAL_CHARS);
		$c_passw=password_hash($pass, PASSWORD_BCRYPT, ['cost'=>12]);
		
		$model=model::getInstance();
		$res=$model->newPass($_SESSION['login'], $c_passw);
		
		if($res!==false)
		{
			header('Location: ./?page=login&info=ok');
		}
		else
		{
			echo "Что то пошло не так!";
			die();
		}
	}
	public function support()
	{
		$name=filter_input(INPUT_POST, 'fio', FILTER_SANITIZE_SPECIAL_CHARS);
		$email=filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
		$quesh=filter_input(INPUT_POST, 'quesion', FILTER_SANITIZE_SPECIAL_CHARS);
		
		$model=model::getInstance();
		$res=$model->sendSupport($name, $email, $quesh);
		if($res!==false)
		{
			header('Location: ./?page=support&info=ok');
		}
		else
		{
			header('Location: ./?page=support&info=error');
		}
	}
}
?>
