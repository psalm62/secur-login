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
		view::all();
		
		if($_SESSION['count']==1)
		{
			session_destroy();
		}
		
?>
		<div class='formV'>
		<p class='textForm'><i class="fa fa-user-plus" aria-hidden="true"> Новый пользователь</i><p>
		<form method='POST'>
		<input type='hidden' name='nameCtr' value='regUser'>
		<div><input class='inputV' type='text' name='login' placeholder='Введите логин' required></div>
		<div><input class='inputV' type='email' name='email' placeholder='Введите Email' required></div>
		<div><input class='inputV' type='password' name='pass1' placeholder='Введите пароль' required></div>
		<div><input class='inputV' type='password' name='pass2' placeholder='Повторите пароль' required></div>
		<div><button class='buttonV'>Регистрация</button></div>
		</form>
		<div class='inputVt'><a class='aHelp' id='visHelp' href='#'>Помощь</a>      <a class='aReg' href='?page=login'>Войти в систему</a></div>
<?php
		if($_SESSION['count']==2)
		{
			echo "<p style='color:red;text-align:center'>Заполните ВСЕ поля!</p>";
		}
		if($_SESSION['count']==3)
		{
			echo "<p style='color:red;text-align:center'>Пароли не совпадают!</p>";
		}
?>
		</div>
		<div id='vButton' class='helpButton helpVis'>
			<div><span id='closeHelp' class='closeH'><i class="fa fa-times fa-lg" aria-hidden="true"></i> Закрыть</span></div>
			<div class='buttonBlok'>
				<div><button>Напомнить логин</button></div>
				<div><button>Напомнить пароль</button></div>
				<div><button>Связаться с поддержкой</button></div>
			</div>
		</div>
<?php	
	}
}
?>
