<?php
/*
 * admin.php
 * 
 * Copyright 2017 -=RaM-= <psalm62@protonmail.com>
 * 
 * 
 */

class admin extends view
{
	public function title()
	{
		echo "<title>Страница администратора</title>";
	}
	public function all()
	{
		if($_GET['info']==ok)
		{
			echo "<p style='font-size:16px;color:green;margin-left:20px'><i class='fa fa-check' aria-hidden='true'> Пароль успешно изменен</i></p>";
		}
		echo "<h1>Страница администратора</h1>";
	
	}
}
?>
