<?php
/*
 * login.php
 * 
 * Copyright 2017 -=RaM-= <psalm62@protonmail.com>
 * 
 * 
 * Форма авторизации пользователя в системе.
 * 
 * 
 */
session_start();

class login extends view
{
	public function all()
	{
		view::all();
		var_dump($_SESSION);

		if($_SESSION['count'] == 1)
		{
			echo "<p style='color:red'>Неверный логин или пароль!</p>";
		}
		if($_SESSION['count']==2 || $_SESSION['count']==3)
		{
			session_destroy();
		}
?>
		
		<form method='POST'>
		<input type='hidden' name='nameCtr' value='testLogin'>
		<input type='text' name='login' placeholder='Введите логин' required>
		<input type='password' name='pass' placeholder='Введите пароль' required>
		<input type=submit>
		</form>
		<p><a href='?page=reg'>Регистрация</a></p>
<?php	
		}
		
}
?>
