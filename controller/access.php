<?php
/*
 * access.php
 * 
 * Copyright 2017 -=RaM=- <psalm62@protonmail.com>
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

class access
{
	static $rights=array(
		'admin'=>array('admin'),
		'user'=>array('admin','user'),
		'logout'=>array('admin', 'user'),
		'reg'=>array(null),
		'login'=>array(null)
	);
	
	public function canAccess($type)
	{
		if($type===null || !array_key_exists($type, self::$rights))
		{
			return false;
		}
		if(in_array($_SESSION['type'], self::$rights[$type]))
		{
			return $this->fastTest($type);
		}
		else
		{
			return false;
		}
	}
	private function fastTest($type)
	{
		$type=trim($type);
		$type=basename($type);
		$filename=realpath("./controller/{$type}.php");
		$type='access'.$type;
		if(file_exists($filename))
		{
			require_once($filename);
			return (new $type)->canAccess();
		}
		else
		{
			return true;
		}
	}
}
?>

