<?php
/*
 * user.php
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

class user extends view
{
	public function title()
	{
		echo "<title>Страница пользователя</title>";
	}
	//~ public function css()
	//~ {
		//~ view::css();
		//~ echo "<style>body {background: #C5C5C5};</style>";
	//~ }
	public function all()
	{
		if($_GET['info']==ok)
		{
			echo "<p style='font-size:16px;color:green;margin-left:20px'><i class='fa fa-check' aria-hidden='true'> Пароль успешно изменен</i></p>";
		}
		if($_GET['info']==mess)
		{
			echo "<p style='font-size:16px;color:green;margin-left:20px'><i class='fa fa-check' aria-hidden='true'> Ваше сообщение отправлено</i></p>";
		}
		if($_GET['info']==oklogin)
		{
			echo "<p style='font-size:16px;color:green;margin-left:20px'><i class='fa fa-check' aria-hidden='true'> Логин успешно изменен</i></p>";
		}
		if($_GET['info']==okemail)
		{
			echo "<p style='font-size:16px;color:green;margin-left:20px'><i class='fa fa-check' aria-hidden='true'> Email успешно изменен</i></p>";
		}
		echo "<h1>Страница пользователя</h1>";
	}
}
?>

