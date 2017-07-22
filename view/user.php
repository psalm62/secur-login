<?php
/*
 * user.php
 * 
 * Copyright 2017 -=RaM-= <psalm62@protonmail.com>
 * 
 */

class user extends view
{
	public function title()
	{
		echo "<title>Страница пользователя</title>";
	}
	public function all()
	{
		if($_GET['info']==ok)
		{
			echo "<p style='font-size:16px;color:green;margin-left:20px'><i class='fa fa-check' aria-hidden='true'> Пароль успешно изменен</i></p>";
		}
		if($_GET['info']==mess)
		{
			echo "<p style='font-size:16px;color:green;margin-left:20px'><i class='fa fa-check' aria-hidden='true'> Ваше сообщение отправлено</i></p>";
		}
		if($_GET['info']==oklogin)
		{
			echo "<p style='font-size:16px;color:green;margin-left:20px'><i class='fa fa-check' aria-hidden='true'> Логин успешно изменен</i></p>";
		}
		if($_GET['info']==okemail)
		{
			echo "<p style='font-size:16px;color:green;margin-left:20px'><i class='fa fa-check' aria-hidden='true'> Email успешно изменен</i></p>";
		}
		echo "<h1>Страница пользователя</h1>";
	}
}
?>

