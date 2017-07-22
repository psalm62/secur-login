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
//session_start();

class login extends view
{
	public function script()
	{
		view::script();
		echo '<script src="js/help.js"></script>';
	}
	public function all()
	{
?>
		
		<div class='formV'>
			<h2 class='nameForm'><i class="fa fa-lock" aria-hidden="true">  SECUR LOGIN</i></h2>
<?php
			if($_GET['info']==1)
			{
				//session_unset('count');
				echo "<p class='ok'><i class='fa fa-at' aria-hidden='true'> Логин отправлен на почту</i></p>";
			}
			if($_GET['info']==ok)
			{
				echo "<p class='ok'><i class='fa fa-check' aria-hidden='true'> Пароль успешно изменен</i></p>";
			}
			if($_GET['info'] ==error)
			{
				echo "<p class='errorpass'>Неверный логин или пароль!</p>";
			}
?>
			<p class='textForm'><i class="fa fa-user" aria-hidden="true"> Логин пользователя</i><p>
			<form method='POST'>
				<input type='hidden' name='nameCtr' value='testLogin'>
				<div><input class='inputV' type='text' name='login' placeholder='Введите логин' required></div>
				<div><input class='inputV' type='password' name='pass' placeholder='Введите пароль' required></div>
				<div><button class='buttonV'>Вход</button></div>
			</form>
			<div class='inputVt'><a class='aHelp' id='visHelp' href='#'>Помощь</a>      <a class='aReg' href='?page=reg'>Регистрация</a></div>
		</div>
		<div id='vButton' class='helpButton helpVis'>
			<div><span id='closeHelp' class='closeH'><i class="fa fa-times fa-lg" aria-hidden="true"></i> Закрыть</span></div>
			<div class='buttonBlok'>
			<div><a href='./?page=reclogin'><button>Напомнить логин</button></a></div>
				<div><a href='./?page=recpass'><button>Напомнить пароль</button></a></div>
				<div><a href='./?page=support'><button>Связаться с поддержкой</button></a></div>
			</div>
		</div>
<?php	
		}
}
?>
