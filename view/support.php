<?php
/*
 * support.php
 * 
 * Copyright 2017 -=RaM=- <psalm62@protonmail.com>
 * 
 */
class support extends view
{
	public function all()
	{
?>		
			<div class='formRec'>
				<i class="fa fa-question fa-4x" aria-hidden="true"> Есть вопросы?</i>
<?php
				if($_GET['info']==ok)
				{
					//echo '<div style="margin: 25px;font-size: 16px;color:green"><i class="fa fa-check" aria-hidden="true"> Ваше сообщение отправлено!</i></div>';
					echo '<div class="alert alert-success" role="alert"><i class="fa fa-check" aria-hidden="true"> Ваше сообщение отправлено!</i></div>';
				}
				if($_GET['info']==error)
				{
					//echo '<div style="margin: 25px;font-size: 16px;color:red"><i class="fa fa-times" aria-hidden="true"> Отправка не удалась.Попробуйте позже.</i></div>';
					echo '<div class="alert alert-danger" role="alert"><i class="fa fa-check" aria-hidden="true"> Отправка не удалась.Попробуйте позже.</i></div>';

				}
?>				
				<div class='inputRec'>
					<form method='POST'>
						<input type='hidden' name='nameCtr' value='support'>
<?php
						if(!$_SESSION['type'])
						{
							echo "<div><input class='inputV' type=text name=fio placeholder='Ваше имя' required></div>";
							echo "<div><input class='inputV' type=email name=email placeholder='Ваш email' required></div>";							
						}
?>
						<div><textarea class='inputT' rows="15" cols="58" name="quesion" placeholder="Опишите свой вопрос" required></textarea></div>
						<div><button class='buttonV'>Отправить</button></div>
					</form>
				</div>		
			</div>
<?php
	}
}
?>
