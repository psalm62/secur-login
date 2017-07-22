<?php
/*
 * view.php
 * 
 * Copyright 2017 -=RaM-= <psalm62@protonmail.com>
 * 
 * 
 */

class view
{
	public function content()
	{
		echo "<html>";
		$this->head();
		$this->body();
		$this->footer();
		echo "</html>";
	}
	public function head()
	{
		echo "<head>";
		$this->title();
		$this->css();
		$this->script();
		echo "</head>";
	}
	public function body()
	{
		echo "<body>";
		$this->menu();
		$this->all();
		echo "</body>";
	}
	public function footer()
	{
		echo "<footer>";
		echo "<div class='copy'>2017 <i class='fa fa-copyright' aria-hidden='true'> БЕЗОПАСНАЯ СИСТЕМА АВТОРИЗАЦИИ.</i></div>";
		echo "</footer>";
	}
	public function title()
	{
		echo '<title>Главная страница</title>';
	}
	public function css()
	{
		echo '<link rel="stylesheet" href="css/font-awesome.min.css">';
		echo '<link rel="stylesheet" type="text/css" href="css/style.css">';
	}
	public function script()
	{
		echo '<script src="js/jquery-3.2.1.min.js"></script>';
	}
	public function menu()
	{
		if(!empty($_SESSION['type']))
		{
			echo "<ul class='menu'><li><a href='./?page={$_SESSION['type']}'><i class='fa fa-home' aria-hidden='true'> Home</i></a></li>"; 
			echo "<li><a href='#'><i class='fa fa-cogs' aria-hidden='true'> Настройки</i></a>
					<ul class='submenu'>
						<li><a href='./?page=newlogin'><i class='fa' aria-hidden='true'> Изменить логин</i></a></li>
						<li><a href='./?page=newpass'><i class='fa' aria-hidden='true'> Изменить пароль</i></a></li>
						<li><a href='./?page=newemail'><i class='fa' aria-hidden='true'> Изменить email</i></a></li>
					</ul>
				</li>";
			if($_SESSION['type']=='admin')
			{
				echo "<li><a href='./?page=users_list'><i class='fa fa-users' aria-hidden='true'> Пользователи</i></a></li>";
			}
			else
			{
				echo "<li><a href='./?page=support'><i class='fa fa-info-circle' aria-hidden='true'> Служба поддержки</i></a></li>";
			}
			echo "<li><a href='?page=logout'><i class='fa fa-sign-out' aria-hidden='true'> Выход</i></a></li></ul>";
		}
		else
		{
			echo "<ul class='menu'><li><a href='./'><i class='fa fa-home' aria-hidden='true'> Home</i></a></li></ul>"; 
		}
	}
	public function all()
	{

	}
}
?>
