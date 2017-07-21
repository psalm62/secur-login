<?php
/*
 * reclogin.php
 * 
 * Copyright 2017 -=RaM=- <psalm62@protonmail.com>
 * 
 */

class reclogin extends view
{
	public function menu()
	{
		echo "<li><a href='./'>На главную</a></li>"; 
	}
	public function all()
	{
		echo <<<reclogin
			<div class='formRec'>
				<i class="fa fa-question fa-4x" aria-hidden="true"> Забыли свой логин?</i>
				<div class='textRec'>
					<i class="fa fa-at" aria-hidden="true"> Укажите email указанный при регистрации и мы вышлем Ваш логин.</i>
				</div>
				<div class='inputRec'>
					<form method='POST'>
						<input type='hidden' name='nameCtr' value='recLogin'>
						<input class='inputV' type=email name=remail placeholder="Ваш email" required>
						<button class='buttonV'>Отправить</button>
					</form>
				</div>		
			</div>
reclogin;
		if($_GET['info']==error)
		{
			echo "<p class='error'><i class='fa fa-times' aria-hidden='true'> Указанный email не найден!</i></p>";
		}
	}
}
?>
