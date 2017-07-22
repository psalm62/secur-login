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
		$email=filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
		$err=filter_input(INPUT_POST, 'err', FILTER_SANITIZE_NUMBER_INT);
		
		
		echo "<h1>Поиcк пользователя</h1>";
		echo <<<SEARCH
		<form method='POST'>
		<input type='hidden' name='err' value='1'>
		Введите <input type='text' name='login' placeholder='ЛОГИН'>
		пользователя или
		<input type='email' name='email' placeholder='EMAIL'>
		<button>Поиск</button>
		</form>
SEARCH;
		// Отправка формы с пустыми полями
		if(empty($login)&&empty($email)&&$err==1)
		{
			echo "<p class='error'><i class='fa fa-times' aria-hidden='true'> Введите хотя бы одно значение!</i></p>";
			die();		
		}
		// Первый вход на эту страницу
		if(empty($_SESSION['usersid'])&&empty($login)&&empty($email)&&$err===NULL)
		{
			die();
		}
		
		$data=array();
		// Если в поиске введен пароль
		if(!empty($login))
		{
			$_SESSION['usersid']=null;
			$data['login']=openssl_encrypt($login, $dbA, $dbClobalKey, OPENSSL_RAW_DATA, $dbGlobalIv);
		}
		// Если в поиске введен email
		if(!empty($email))
		{
			$_SESSION['usersid']=null;
			$data['email']=openssl_encrypt($email, $dbA, $dbClobalKey, OPENSSL_RAW_DATA, $dbGlobalIv);
		}
		// Используется после отправки формы смены статуса и типа учетной записи
		if(!empty($_SESSION['usersid']))
		{
			$data['id']=$_SESSION['usersid'];
		}
		
		$model=model::getInstance();
		$row=$model->searchUserData($data);
		if($row===NULL)
		{
			echo "<p class='error'><i class='fa fa-times' aria-hidden='true'> Такого пользователя не существует!</i></p>";
			die();
		}
		// Пишем в сессию, для сохранения выбранного пользователя после смены его статусов
		$_SESSION['usersid']=$row['id'];
		
		$d_login=openssl_decrypt($row['login'], $dbA, $dbClobalKey, OPENSSL_RAW_DATA, $dbGlobalIv);
		$d_email=openssl_decrypt($row['email'], $dbA, $dbClobalKey, OPENSSL_RAW_DATA, $dbGlobalIv);
		
		static $status_p=array(
			'admin'=>'Admin',
			'user'=>'User'
			);
			
		if($row['status']==0)
		{
			$status='Заблокировать';
			$newstatus=1;
		}
		else
		{
			$status='Разблокировать';
			$newstatus=0;
		}
		echo "<table><tr><th>Логин</th><th>Email</th><th>Права доступа</th><th></th><th></th></tr>";
		echo "<tr><td>{$d_login}</td><td>{$d_email}</td>";
		echo "<td>";
		// Проверка, чтобы админ не сменил себя на user
		if($_SESSION['id']!=$row['id'])
		{
			// Смена типа учетной записи
			$formid=$row['id'].'-type';
			echo "<form id={$formid} method='POST'>";
			echo "<input type='hidden' name='nameCtr' value='sendType'>";
			echo self::select($status_p, $row['type'], 'type', $formid);
			echo "</form>";
		}
		else
		{
			echo $row['type'];
		}
		echo "</td><td>";
		// Проверка, чтобы админ не заблокировал сам себя
		if($_SESSION['id']!=$row['id'])
		{
			// Блокирование доступа для учетных записей
			echo "<form id={$formid}.'-s' method='POST'>";
			echo "<input type='hidden' name='nameCtr' value='lock'>";
			echo "<input type='hidden' name='newstat' value={$newstatus}>";
			echo "<button onchange={$formid}.'-s'>{$status}</button>";
			echo "</form>";
		}
		else
		{
			echo "Недоступно";
		}
		echo "</td><td>";
		// Проверка, чтобы админ не удалил сам себя
		if($_SESSION['id']!=$row['id'])
		{
			// Удаление учетных записей
			echo "<form id={$formid}.'-d' method='POST'>";
			echo "<input type='hidden' name='nameCtr' value='delUser'>";
			echo "<button onchange={$formid}.'-d'>Удалить пользователя</button>";
			echo "</form>";
		}
		else
		{
			echo "Недоступно";
		}
		echo "</td></tr>";
	}
	static function select($options, $selected, $name, $formid) 	// Генерируем select для смены типа пользователей
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
