<?php
/*
 * admin.php
 * 
 * Copyright 2017 -=RaM-= <psalm62@protonmail.com>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
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
			echo "<p style='font-size:16px;color:green;margin-left:20px'><i class='fa fa-check' aria-hidden='true'> Пароль успешно изменен</i></p>";
		}
		echo "<h1>Страница администратора</h1>";
		//~ echo <<<SEARCH
		//~ <form method='POST'>
		//~ <input type='hidden' name='nameCtr' value='searchUser'>
		//~ Введите <input type='text' name='login' placeholder='ЛОГИН'>
		//~ пользователя или
		//~ <input type='email' name='email' placeholder='EMAIL'>
		//~ <button>Поиск</button>
		//~ </form>
//~ SEARCH;
		//~ if($_GET['info']==error)
		//~ {
			//~ echo "<p class='error'><i class='fa fa-times' aria-hidden='true'> Введите хотя бы одно значение!</i></p>";
		//~ }
	}
}
?>
