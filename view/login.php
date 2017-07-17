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
		
		if($_SESSION['count']==2 || $_SESSION['count']==3)
		{
			session_destroy();
		}
?>
		
		<div class='formV'>
		<h2 class='nameForm'><i class="fa fa-lock" aria-hidden="true">  SECUR LOGIN</i></h2>
		<p class='textForm'><i class="fa fa-user" aria-hidden="true"> Логин пользователя</i><p>
		<form method='POST'>
		<input type='hidden' name='nameCtr' value='testLogin'>
		<div><input class='inputV' type='text' name='login' placeholder='Введите логин' required></div>
		<div><input class='inputV' type='password' name='pass' placeholder='Введите пароль' required></div>
		<div><button class='buttonV'>Вход</button></div>
		</form>
		<div class='inputVt'><a class='aHelp' href='#'>Помощь</a>      <a class='aReg' href='?page=reg'>Регистрация</a></div>
<?php			
		if($_SESSION['count'] == 1)
		{
			echo "<p style='color:red;text-align:center;margin-bottom: 20px'>Неверный логин или пароль!</p>";
		}
?>
		</div>
<?php	
		}
}
?>
