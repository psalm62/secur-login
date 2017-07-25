<?php
/*
 * user.php
 * 
 * Copyright 2017 -=RaM-= <psalm62@protonmail.com>
 * 
 */

class user extends view
{
	public function title()
	{
		echo "<title>Страница пользователя</title>";
	}
	public function all()
	{
		var_dump($_SERVER['HTTP_COOKIE']);

		//~ if($_GET['info']==ok)
		//~ {
			//~ echo "<p style='font-size:16px;color:green;margin-left:20px'><i class='fa fa-check' aria-hidden='true'> Пароль успешно изменен</i></p>";
		//~ }
		if($_GET['info']==ok)
		{
			echo '<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<strong>Отлично!</strong> Пароль успешно изменен.
			</div>';
		}
		if($_GET['info']==mess)
		{
			//echo "<p style='font-size:16px;color:green;margin-left:20px'><i class='fa fa-check' aria-hidden='true'> Ваше сообщение отправлено</i></p>";
			echo '<div class="alert alert-success" role="alert"><i class="fa fa-check" aria-hidden="true"> Ваше сообщение отправлено!</i></div>';
		}
		if($_GET['info']==oklogin)
		{
			echo "<p style='font-size:16px;color:green;margin-left:20px'><i class='fa fa-check' aria-hidden='true'> Логин успешно изменен</i></p>";
		}
		if($_GET['info']==okemail)
		{
			echo "<p style='font-size:16px;color:green;margin-left:20px'><i class='fa fa-check' aria-hidden='true'> Email успешно изменен</i></p>";
		}
		echo "<h2 style='margin:40px'>Отправленные сообщения</h2>";
		
		$model=model::getInstance();
		$data=$model->getMessages($_SESSION['id']);
		echo '<div class="container">';
			echo "<div class='row'>";
			echo "<ul class='col-md-6 list-group'>
					<li class='list-group-item list-group-item-info'>
						<span class='badge'>".count($data)."</span>
						Количество сообщений
					</li>
				</ul>";
			echo "</div>";

		foreach($data as $row)
		{
			echo "<div class='panel panel-primary'>
					<div class='panel-heading'>
						<h3 class='panel-title'>{$row['email']}</h3>
					</div>
					<div class='panel-body'>
						<div class='col-md-10'>{$row['ques']}</div>
						<div class='col-md-2'>
							<form method='POST'>
								<input type='hidden' name='nameCtr' value='delMess'>
								<input type='hidden' name='messid' value={$row['id']}>
							
						</div>
					</div>
					<div class='panel-footer'><button class='btn btn-danger'><i class='fa fa-trash-o'> Удалить</i></button></div></form>
				</div>";
		}
	}
}
?>

