<?php
/*
 * model.php
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
class model
{
	protected $dbh;
	private static $instance=null;
	
	private function __construct()
	{
		global $dbName, $dbHost, $dbUser, $dbPass;
		try
		{
			$this->dbh=new PDO("mysql:dbname={$dbName};dbhost={$dbHost}", $dbUser, $dbPass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
		}
		catch (PDOException $e)
		{
			echo '<p>Не получилось подключиться к базе</p>';
			die();
		}
		
	}
	public static function getInstance()
	{
		if(self::$instance==null)
		{
			self::$instance=new model();
		}
		return self::$instance;
	}
	public function testUser($login, $pass)
	{
		$stmt=$this->dbh->prepare(
			"SELECT * FROM `reg_user` WHERE `login`=:login"
		);
		$stmt->bindValue(':login', $login);
		$stmt->execute();
		if(($row=$stmt->fetch()) && password_verify($pass, $row['pass']))
		{
			return $row;
		}
		else
		{
			return false;
		}
	}
	public function regUser($login, $pass, $email)
	{
		$stmt=$this->dbh->prepare(
			'INSERT INTO `reg_user`(`login`,`pass`,`email`)
			VALUES (:login, :pass, :email)'
		);
		$stmt->bindValue(':login', $login);
		$stmt->bindValue(':pass', $pass);
		$stmt->bindValue(':email', $email);
		$res=$stmt->execute();
		
		return $res;
	}
}
?>
