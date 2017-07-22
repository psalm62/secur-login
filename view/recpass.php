<?php
/*
 * recpass.php
 * 
 * Copyright 2017 -=RaM=- <psalm62@protonmail.com>
 * 
 */
class recpass extends view
{
	public function all()
	{
		echo <<<recpass
			<div class='formRec'>
				<i class="fa fa-question fa-4x" aria-hidden="true"> Забыли свой пароль?</i>
				<div class='textRec'>
					<i class="fa fa-user-o" aria-hidden="true"> Укажите логин указанный при регистрации.</i>
				</div>
				<div class='inputRec'>
					<form method='POST'>
						<input type='hidden' name='nameCtr' value='getCode'>
						<input class='inputV' type=text name=login placeholder="Ваш логин" required>
						<button class='buttonV'>Отправить</button>
					</form>
				</div>
				<div class='textRec'>
					<i class="fa fa-check" aria-hidden="true"> <a href="./?page=vercode">Уже есть код.</a></i>
				</div>		
			</div>
recpass;
		if($_GET['info']==error)
		{
			echo "<p class='error'><i class='fa fa-times' aria-hidden='true'> Указанный login не найден!</i></p>";
		}
	}
}
?>
