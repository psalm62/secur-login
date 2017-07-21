<?php
/*
 * recode.php
 * 
 * Copyright 2017 -=RaM=- <psalm62@protonmail.com>
 * 
 */
class vercode extends view
{
	public function menu()
	{
		echo "<li><a href='./'>На главную</a></li>"; 
	}
	public function all()
	{
		echo <<<recod
			<div class='formRec'>
				<i class="fa fa-envelope-open fa-3x" aria-hidden="true"> Проверьте email</i>
				<div class='inputRec'>
					<form method='POST'>
						<input type='hidden' name='nameCtr' value='verifyCod'>
						<input class='inputV' type=text name=cod placeholder="Кодовое слово" required>
						<button class='buttonV'>Отправить</button>
					</form>
				</div>
			</div>
recod;
		if($_GET['info']==error)
		{
			echo "<p class='error'><i class='fa fa-times' aria-hidden='true'> Введенный код не верный!</i></p>";
		}
	}
}
?>
