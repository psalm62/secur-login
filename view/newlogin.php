<?php
/*
 * newlogin.php
 * 
 * Copyright 2017 -=RaM=- <psalm62@protonmail.com>
 * 
 * 
 */
class newlogin extends view
{
	public function all()
	{
		echo <<<newl
			<div class='formRec'>
				<i class="fa fa-question fa-4x" aria-hidden="true"> Хотите изменить логин?</i>
				<div class='textRec'>
					<i class="fa fa-user-o" aria-hidden="true"> Укажите новый логин.</i>
				</div>
				<div class='inputRec'>
					<form method='POST'>
						<input type='hidden' name='nameCtr' value='newLogin'>
						<input class='inputV' type=text name=login placeholder="Новый логин" required>
						<button class='buttonV'>Отправить</button>
					</form>
				</div>
			</div>
newl;
		if($_GET['info']==error)
		{
			echo '<div class="alert alert-danger" role="alert"><b>Ошибка!</b> Такой логин уже занят!</div>';
		}
	}
}
?>
