<?php 
	session_start();
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
	date_default_timezone_set('America/Belem');
	spl_autoload_register(function($class){include('classes/'.$class.'.php');});
	require 'vendor/autoload.php';
	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();
  define('WWW', 'http://localhost/c2a-web/');
  define('WWW_START', 'localhost');
  define('TITULO', 'C2A');
	define('BASE_DIR_PATH', __DIR__.'/img/');
	//CONECTA AO BANCO DE DADOS
	define('HOST', $_ENV['HOST']);
	define('USER', $_ENV['USERDB']);
	define('PASSWORD', $_ENV['PASSWORD']);
	define('DATABASE', $_ENV['DATABASE']);
	
	//acrecenta zero a esquerda
	function ZeroEsquerda($numero,$casas){
	    return str_pad($numero, $casas, "0", STR_PAD_LEFT);
	}
  
	function verificaPermissaoMenu($permissao){
		if ($_SESSION['cargo']>$permissao) {
			return;
		}else{
			echo 'style="display:none;"';
		}
	}
	function verificaPermissaoPagina($permissao){
		if ($_SESSION['cargo']<=$permissao) {
			return;
		}else{
			include('administrador/view/acesso-negado.php');
			die();
		}
	}
	function trataString($value){
		$encontrar = array('"',"'",'`');
		$substituir = array('&quot;',"&#39;",'&grave;');
		$replace = str_replace($encontrar, $substituir, $value);
		return $replace;
	}
	function trataNumero($value){
		$encontrar = array('.000', 'NULL');
		$substituir = array('');
		$replace = str_replace($encontrar, $substituir, $value);
		return $replace;
	}
	function recoveryPost($post){
		if (isset($_POST[$post])) {
			echo $_POST[$post];
		}
	}
	function data($data){
    return date("d/m/Y", strtotime($data));
	}
	function dataFormat($data){
		$dataFormt = strftime('%B %Y',strtotime($data));
		$dataExplo = explode(' ', $dataFormt);
		//$dataCaracter = strtoupper (substr($dataExplo[0],0,3));
		$dataCaracter = ucfirst(substr($dataExplo[0],0,3));
		$dataFORMATADA = $dataCaracter.' '.$dataExplo[1];
		//FORMATO NOV 2020
    return $dataFORMATADA;
	}
	function formataCaracteres($string, $indice, $retorno){
		#PEGA O TEXTO ATE O INDICE ESCOLHIDO
		$sub = strip_tags(substr($string,0,$indice));
		#RETIRA AS TAGS HTML
    $sub = html_entity_decode($sub);
    #RETORNA CARACTERES ATÉ O NUMERO DE RETORNO
    return substr($sub, 0,$retorno);
	}
	function idUrl($arr){
	  //FUNÇÃO IDENTIFICA A PÁGINA QUE ESTÁ
	  $i = count($arr);
	  $contador = 1;
	  if($i>0){
	    foreach($arr as $key =>$val){
	      if($i==1){
	        echo '?'.$key.'='.$val;
	      }else if($i>1 AND $contador==1){
	        echo '?'.$key.'='.$val;
	      }elseif($i>1 AND $contador!=1){
	        echo '&'.$key.'='.$val;
	      }
	     $contador++;
	    }
	  }
	}
	function contaPDF($path) {
	  //CONTA PÁGINAS DO PDF
	  $pdf = file_get_contents($path);
	  $number = preg_match_all("/\/Page\W/", $pdf, $dummy);
	  return $number;
	}
?>