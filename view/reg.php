<?php
/*
 * reg.php
 * 
 * Copyright 2017 -=RaM-= <whoram@protonmail.com>
 * 
 * 
 * Форма регистрации пользователя в системе.
 * 
 * 
 */

class reg extends view
{
	public function all()
	{
		view::all();
		if($_SESSION['count']==2)
		{
			echo "<p style='color:red'>Заполните ВСЕ поля!</p>";
		}
		if($_SESSION['count']==3)
		{
			echo "<p style='color:red'>Пароли не совпадают!</p>";
		}
		if($_SESSION['count']==1)
		{
			session_destroy();
		}
		
?>
		<form method='POST'>
		<input type='hidden' name='nameCtr' value='regUser'>
		<input type='text' name='login' placeholder='Введите логин' required>
		<input type='email' name='email' placeholder='Введите email' >
		<input type='password' name='pass1' placeholder='Введите пароль' required>
		<input type='password' name='pass2' placeholder='Повторите пароль' required>
		<input type=submit>
		</form>
		<p><a href='?page=login'>Войти в систему</a></p>
<?php	
	}
}
?>
