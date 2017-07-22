<?php
/*
 * newemail.php
 * 
 * Copyright 2017 -=RaM=- <psalm62@protonmail.com>
 * 
 * This program is free software; you can redistribute it and/or modify
 * 
 */
class newemail extends view
{
	public function all()
	{
		echo <<<newe
			<div class='formRec'>
				<i class="fa fa-question fa-4x" aria-hidden="true"> Решили изменить email?</i>
				<div class='textRec'>
					<i class="fa fa-at" aria-hidden="true"> Введите новый email.</i>
				</div>
				<div class='inputRec'>
					<form method='POST'>
						<input type='hidden' name='nameCtr' value='newEmail'>
						<input class='inputV' type=email name=email placeholder="Новый email" required>
						<button class='buttonV'>Отправить</button>
					</form>
				</div>		
			</div>
newe;
	}
}
?>
