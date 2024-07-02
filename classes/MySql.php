<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	class MySql
	{
		private static $pdo;

		public static  function conectar()
		{
			if (self::$pdo==null) {
				try {
					self::$pdo = new PDO('mysql:host='.HOST.';dbname='.DATABASE,USER,PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
					//MODO DE DESENVOLVIMENTO
					self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				} catch (PDOException $e) {
					echo "erro ao conectar";
					die();
				}
			}
			return self::$pdo;
		}
	}
?>