<?php
/*
 * view.php
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

class view
{
	public function content()
	{
		echo "<html>";
		$this->head();
		$this->body();
		$this->footer();
		echo "</html>";
	}
	public function head()
	{
		echo "<head>";
		$this->title();
		$this->css();
		$this->script();
		echo "</head>";
	}
	public function body()
	{
		echo "<body>";
		$this->all();
		echo "</body>";
	}
	public function footer()
	{
		echo "<footer>";
		echo "</footer>";
	}
	public function title()
	{
		echo '<title>Главная страница</title>';
	}
	public function css()
	{
		
	}
	public function script()
	{
	
	}
	public function all()
	{
		
	}
}
?>
