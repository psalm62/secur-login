<?php
/*
 * reg.php
 * 
 * Copyright 2017 -=RaM-= <psalm62@protonmail.com>
 * 
 * 
 * Форма регистрации пользователя в системе.
 * 
 * 
 */

class reg extends view
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
			<p class='textForm'><i class="fa fa-user-plus" aria-hidden="true"> Новый пользователь</i><p>
			<form method='POST'>
				<input type='hidden' name='nameCtr' value='regUser'>
				<div><input class='inputV' type='text' name='login' placeholder='Введите логин' required></div>
				<div><input class='inputV' type='email' name='email' placeholder='Введите Email' required></div>
				<div><input class='inputV' type='password' name='pass1' placeholder='Введите пароль' required></div>
				<div><input class='inputV' type='password' name='pass2' placeholder='Повторите пароль' required></div>
				<div class="g-recaptcha" data-sitekey="6LeOQCoUAAAAAOwoWkwtc3DVlYAWoBbG4sE4RaTA"></div>
				<div><button class='buttonV'>Регистрация</button></div>
			</form>
			<div class='inputVtr'><a class='aHelp' id='visHelp' href='#'>Помощь</a>      <a class='aReg' href='?page=login'>Войти в систему</a></div>
<?php
			if($_GET['info']==err)
			{
				echo "<p class='errorpass'>Заполните ВСЕ поля!</p>";
			}
			if($_GET['info']==errpass)
			{
				echo "<p class='errorpass'>Пароли не совпадают!</p>";
			}
			if($_GET['info']==errlogin)
			{
				echo "<p class='errorpass'>Логин занят!</p>";
			}
			if($_GET['info']==errcaptcha)
			{
				echo '<div class="alert alert-danger" role="alert"><strong>Ошибка!</strong> подтвердите каптчу!</div>';
			}
?>
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
