<?php
/*
 * support.php
 * 
 * Copyright 2017 -=RaM=- <psalm62@protonmail.com>
 * 
 */
class support extends view
{
	public function menu()
	{
		echo "<li><a href='./'>На главную</a></li>"; 
	}
	public function all()
	{
?>		
			<div class='formRec'>
				<i class="fa fa-question fa-4x" aria-hidden="true"> Есть вопросы?</i>
<?php
				if($_SESSION['qw']==1)
				{
					echo '<div style="margin: 25px;font-size: 16px;color:green"><i class="fa fa-check" aria-hidden="true"> Ваше сообщение отправлено!</i></div>';
				}
				if($_SESSION['qw']==2)
				{
					echo '<div style="margin: 25px;font-size: 16px;color:red"><i class="fa fa-times" aria-hidden="true"> Отправка не удалась.Попробуйте позже.</i></div>';
				}
?>				
				<div class='inputRec'>
					<form method='POST'>
						<input type='hidden' name='nameCtr' value='support'>
						<div><input class='inputV' type=text name=fio placeholder="Ваше имя" required></div>
						<div><input class='inputV' type=email name=email placeholder="Ваш email" required></div>
						<div><textarea class='inputT' rows="15" cols="58" name="quesion" placeholder="Опишите свой вопрос" required></textarea></div>
						<div><button class='buttonV'>Отправить</button></div>
					</form>
				</div>		
			</div>
<?php
	}
}
?>
