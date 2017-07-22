<?php
/*
 * users_list.php
 * 
 * Copyright 2017 -=RaM=- <psalm62@protonmail.com>
 * 
 */

class users_list extends view
{
	public function title()
	{
		echo "<title>Страница поиска пользователей</title>";
	}
	public function script()
	{
		view::script();
		echo "<script src='js/sendform.js'></script>";
	}
	public function all()
	{
		global $dbA, $dbClobalKey, $dbGlobalIv;
		
		$login=filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
		$email=filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
		$err=filter_input(INPUT_POST, 'err', FILTER_VALIDATE_INT);
		
		
		echo "<h1>Посик пользователя</h1>";
		echo <<<SEARCH
		<form method='POST'>
		<input type='hidden' name='err' value='1'>
		Введите <input type='text' name='login' placeholder='ЛОГИН'>
		пользователя или
		<input type='email' name='email' placeholder='EMAIL'>
		<button>Поиск</button>
		</form>
SEARCH;
		//=====================================================================
		if(empty($login)&&empty($email)&&$err==1)
		{
			echo "<p class='error'><i class='fa fa-times' aria-hidden='true'> Введите хотя бы одно значение!</i></p>";
			die();		
		}

		if(empty($login)&&empty($email)&&$err===NULL)
		{
			$login=$_SESSION['userl'];
			$email=$_SESSION['emaill'];
			if(empty($login))
			{
				die();
			}
		}
		$data=array();
		
		if(!empty($login))
		{
			$_SESSION['userl']=$login;
			$data['login']=openssl_encrypt($_SESSION['userl'], $dbA, $dbClobalKey, OPENSSL_RAW_DATA, $dbGlobalIv);
		}
		if(!empty($email))
		{
			$_SESSION['emaill']=$email;
			$data['email']=openssl_encrypt($_SESSION['emaill'], $dbA, $dbClobalKey, OPENSSL_RAW_DATA, $dbGlobalIv);
		}
		//~ if($err!=1&&empty($_SESSION['userl'])&&empty($_SESSION['emaill']))
		//~ {
			//~ die();
		//~ }
		
		$model=model::getInstance();
		$row=$model->searchUserData($data);
		if($row===NULL)
		{
			echo "<p class='error'><i class='fa fa-times' aria-hidden='true'> Такого пользователя не существует!</i></p>";
			die();
		}
		
		$d_login=openssl_decrypt($row['login'], $dbA, $dbClobalKey, OPENSSL_RAW_DATA, $dbGlobalIv);
		$d_email=openssl_decrypt($row['email'], $dbA, $dbClobalKey, OPENSSL_RAW_DATA, $dbGlobalIv);
		
		static $status_p=array(
			'admin'=>'Admin',
			'user'=>'User'
			);
			
		if($row['status']==0)
		{
			$status='Заблокировать';
		}
		else
		{
			$status='Разблокировать';
		}
		echo "<table><tr><th>Логин</th><th>Email</th><th>Права доступа</th><th></th><th></th></tr>";
		echo "<tr><td>{$d_login}</td><td>{$d_email}</td>";
		echo "<td>";
		if($_SESSION['id']!=$row['id'])
		{
			$formid=$row['id'].'-type';
			echo "<form id={$formid} method='POST'>";
			echo "<input type='hidden' name='nameCtr' value='sendType'>";
			echo "<input type='hidden' name='id' value={$row['id']}>";
			echo self::select($status_p, $row['type'], 'type', $formid);
			echo "</form>";
		}
		else
		{
			echo $row['type'];
		}
		echo "</td><td><button id='status'>{$status}</button></td><td><button>Удалить</button></td></tr>";
	}
	static function select($options, $selected, $name, $formid)
	{
		$result="<select name='{$name}' onchange='sendform(\"$formid\")'>";
		foreach($options as $key => $value)
		{
			$result.="<option value='{$key}' ";
			if($key==$selected)
			{
				$result.='selected';
			}
			$result.=">{$value}</option>";
		}
		$result.="</select>";
		return $result;
	}
}
?>
