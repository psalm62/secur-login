<?php
/*
 * newpass.php
 * 
 * Copyright 2017 -=RaM=- <psalm62@protonmail.com>
 * 
 * 
 */
class newpass extends view
{
	public function all()
	{
		echo <<<pass
			<div class='formRec'>
				<i class="fa fa-envelope-open fa-3x" aria-hidden="true"> Введите новый пароль</i>
				<div class='inputRec'>
					<form method='POST'>
						<input type='hidden' name='nameCtr' value='newPassword'>
						<input class='inputV' type=password name='pass1' placeholder="Новый пароль" required>
						<input class='inputV' type=password name='pass2' placeholder="Повторите пароль" required>
						<button class='buttonV'>Отправить</button>
					</form>
				</div>
			</div>
pass;
		if($_GET['info']==error)
		{
			//echo "<p class='error'><i class='fa fa-times' aria-hidden='true'> Введенные пароли не совпадают!</i></p>";
			echo '<div class="alert alert-danger" role="alert"><b>Ошибка!</b> Введенные пароли не совпадают!</div>';
		}
	}
}
?>
