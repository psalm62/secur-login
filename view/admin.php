<?php
/*
 * admin.php
 * 
 * Copyright 2017 -=RaM-= <psalm62@protonmail.com>
 * 
 * 
 */

class admin extends view
{
	public function title()
	{
		echo "<title>Страница администратора</title>";
	}
	public function all()
	{
		if($_GET['info']==ok)
		{
			//echo "<p style='font-size:16px;color:green;margin-left:20px'><i class='fa fa-check' aria-hidden='true'> Пароль успешно изменен</i></p>";
			echo '<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<strong>Отлично!</strong> Пароль успешно изменен.
			</div>';
		}
		
		$model=model::getInstance();
		$data=$model->getMessages();
		
		echo "<h2 style='margin:40px'>Принятые сообщения от пользователей</h2>";
		
		 		
		echo '<div class="container"><div class="row">';
			echo "<ul style='width:400px' class='list-group'>
					<li class='list-group-item list-group-item-info'>
						<span class='badge'>".count($data)."</span>
						Количество сообщений
					</li>
				</ul>";
			
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
									<button class='btn btn-danger'><i class='fa fa-trash-o'> Удалить</i></button>
								</form>
							</div>
						</div>
						<div class='panel-footer'><button class='btn btn-primary'><i class='fa fa-envelope-o' aria-hidden='true'> Ответить</i></button> </div>
					</div>";
			}
		echo "</div></div>";
	}
}
?>
