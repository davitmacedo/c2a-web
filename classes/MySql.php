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
		public static function testeConexao()
		{
			try {
				$pdo = self::conectar();
				$stmt = $pdo->query("SELECT 1");
				$result = $stmt->fetch();
				if ($result) {
					echo "Conexão estabelecida e consulta executada com sucesso!";
				} else {
					echo "Conexão estabelecida, mas a consulta não retornou resultados.";
				}
			} catch (PDOException $e) {
				echo "Erro ao executar consulta: " . $e->getMessage();
			}
		}
	}
?>