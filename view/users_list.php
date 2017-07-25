<?php
/*
 * users_list.php
 * 
 * Copyright 2017 -=RaM=- <psalm62@protonmail.com>
 * 
 * 
 * 
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
		
		echo "<p style='margin:20px' class='fa fa-2x'> Поиcк пользователя</p><br>";
		echo <<<SEARCH
			<form method='POST'>
				<input type='hidden' name='err' value='1'>
				<span style='margin-left:10px'>Введите </span><input type='text' name='login' placeholder='ЛОГИН'>
				или
				<input type='email' name='email' placeholder='EMAIL'> пользователя
				<button class='btn btn-primary'><i class='fa fa-search'> Найти</i></button>
			</form>
SEARCH;
		
		$model=model::getInstance();
		$data=array();
		
		// Отправка формы с пустыми полями - вывод всех пользователей
		if(empty($login)&&empty($email)&&$err==1)
		{
			$_SESSION['s_login']=null;
			$_SESSION['s_email']=null;
			$_SESSION['usersid']='all';
		}
		
		// Если в поиске введен пароль
		elseif(!empty($login))
		{
			$_SESSION['usersid']=null;
			$_SESSION['s_email']=null;
			$data['login']=openssl_encrypt($login, $dbA, $dbClobalKey, OPENSSL_RAW_DATA, $dbGlobalIv);
			$_SESSION['s_login']=$data['login'];
		}
		
		// Если в поиске введен email
		elseif(!empty($email))
		{
			$_SESSION['s_login']=null;
			$_SESSION['usersid']=null;
			$data['email']=openssl_encrypt($email, $dbA, $dbClobalKey, OPENSSL_RAW_DATA, $dbGlobalIv);
			$_SESSION['s_email']=$data['email'];
		}

		// После обновления данных если выборка была по email
		elseif(!empty($_SESSION['s_email']))
		{
			$_SESSION['s_login']=null;
			$data['email']=$_SESSION['s_email'];
		}

		// После обновления данных если выборка была по login
		elseif(!empty($_SESSION['s_login']))
		{
			$_SESSION['s_email']=null;
			$data['login']=$_SESSION['s_login'];
		}
		
		// После обновления данных если выборка была по всем пользователям
		elseif($_SESSION['usersid']=='all')
		{
			$data=null;
		}

		else
		{
			die();
		}
		
		$dataall=$model->searchUserData($data);
		if($dataall===NULL)
		{
			echo '<div class="alert alert-danger" role="alert"><b>Ошибка!</b> Такого пользователя не существует!</div>';
			//echo "<p class='error'><i class='fa fa-times' aria-hidden='true'> Такого пользователя не существует!</i></p>";
			die();
		}
		
		echo "<table class='table'><tr><th><i class='fa fa-user-o'> Логин</i></th><th><i class='fa fa-at'> Электронная почта</i>
			</th><th><i class='fa fa-square-o'> Уровень доступа</i></th><th><i class='fa fa-lock'> Доступ в систему</i></th><th><i class='fa fa-user-times'> Другие действия</i></th></tr>";
		foreach($dataall as $row)
		{
			echo "<tr>";		
			foreach($row as $key => $value)
			{
				if($key=='login')
				{
					$d_login=openssl_decrypt($value, $dbA, $dbClobalKey, OPENSSL_RAW_DATA, $dbGlobalIv);
					echo "<td>{$d_login}</td>";
				}
				if($key=='email')
				{
					$d_email=openssl_decrypt($value, $dbA, $dbClobalKey, OPENSSL_RAW_DATA, $dbGlobalIv);
					echo "<td>{$d_email}</td>";
				}
				
				if($key=='type')
				{
					static $status_p=array(
						'admin'=>'Admin',
						'user'=>'User'
					);
					echo "<td>";
					// Проверка, чтобы админ не сменил себя на user
					if($_SESSION['id']!=$row['id'])
					{
						// Смена типа учетной записи
						$formid=$row['id'].'-type';
						echo "<form id={$formid} method='POST'>";
						echo "<input type='hidden' name='nameCtr' value='sendType'>";
						echo "<input type='hidden' name='useri' value='{$row['id']}'>";
						echo self::select($status_p, $value, 'type', $formid);
						echo "</form>";
					}
					else
					{
						echo $value;
					}
					echo "</td>";
				}
				if($key=='status')
				{
					if($value==0)
					{
						$status='Заблокировать';
						$newstatus=1;
					}
					else
					{
						$status='Разблокировать';
						$newstatus=0;
					}
					echo "<td>";
					// Проверка, чтобы админ не заблокировал сам себя
					if($_SESSION['id']!=$row['id'])
					{
						// Блокирование доступа для учетных записей
						$formid=$row['id'].'-s';
						echo "<form id={$formid} method='POST'>";
						echo "<input type='hidden' name='nameCtr' value='lock'>";
						echo "<input type='hidden' name='newstat' value={$newstatus}>";
						echo "<input type='hidden' name='useri' value='{$row['id']}'>";
						echo "<button class='btn btn-primary' onchange={$formid}>{$status}</button>";
						echo "</form>";
					}
					else
					{
						echo "<button class='btn btn-primary' disabled='disabled'>{$status}</button>";
					}
					echo "</td>";
				
				}
				
			}
			echo "<td>";
			// Проверка, чтобы админ не удалил сам себя
			if($_SESSION['id']!=$row['id'])
			{
				// Удаление учетных записей
				$formid=$row['id'].'-d';
				echo "<form id={$formid} method='POST'>";
				echo "<input type='hidden' name='nameCtr' value='delUser'>";
				echo "<input type='hidden' name='useri' value='{$row['id']}'>";
				echo "<button class='btn btn-danger' onchange={$formid}><i class='fa fa-trash-o'></i> Удалить пользователя</button>";
				echo "</form>";
			}
			else
			{
				//echo "Недоступно";
				echo "<button class='btn btn-danger' disabled='disabled'><i class='fa fa-trash-o'></i> Удалить пользователя</button>";

			}
			echo "</td>";
			echo "</tr>";
		}
	}
	static function select($options, $selected, $name, $formid) 	// Генерируем select для смены типа пользователей
	{
		$result="<select class='form-control' name='{$name}' onchange='sendform(\"$formid\")'>";
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
