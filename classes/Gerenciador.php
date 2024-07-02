<?php
class Gerenciador{
  public static function generateSlug($str){
    $str = mb_strtolower($str);
    $str = preg_replace('/(â|á|ã|à)/', 'a', $str);
    $str = preg_replace('/(ê|é)/', 'e', $str);
    $str = preg_replace('/(í|Í)/', 'i', $str);
    $str = preg_replace('/(ú)/', 'u', $str);
    $str = preg_replace('/(ó|ô|õ|Ô)/', 'o',$str);
    $str = preg_replace('/(_|\/|!|\?|#)/', '',$str);
    $str = preg_replace('/( )/', '-',$str);
    $str = preg_replace('/ç/','c',$str);
    $str = preg_replace('/(-[-]{1,})/','-',$str);
    //$str = preg_replace('/(,)/','-',$str);
    $str = preg_replace('/(,)/','',$str);
    $str=strtolower($str);
    return $str;
  }

  public static function logado() {
      return isset($_SESSION['login']) ? true : false;
  }

  public static function loggout()
  {
    setcookie('lembrar', false, time()-1, '/');
    session_destroy();
    header('Location: '.WWW);
  }

  public static function alert($tipo, $mensagem){
    echo '<div class="alert alert-'.$tipo.' alert-dismissible fade show" role="alert">'.$mensagem.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button></div>';
  }
  
  public static function imagemValida($imagem){
    if ($imagem['type']=='image/jpeg' || $imagem['type']=='image/jpg' || $imagem['type']=='image/png' || $imagem['type']=='image/gif' ||  $imagem['type']=='image/webp' || $imagem['type']=='video/mpeg' || $imagem['type']=='video/mp4') {
      $tamanho = intval($imagem['size']/1024);

      if($imagem['type']=='image/gif'){
        //PARA GIF aceito até 10MB
        if($tamanho<=10000)
          return true;
        else
          return false;
        }else{
        if($tamanho<2000){
          return true;
        }else{
          return false;
        }
      }
    }else{
      return false;
    }
  } 
  public static function uploadArquivosInscricao($file, $pasta, $insc){
    $formatoArquivo = explode('.', $file['name']);
    if($insc=='') return false;
    $imagemNome = $insc.'-'.date('Ymd').'.'.$formatoArquivo[count($formatoArquivo)-1];
    //'C://xampp/htdocs/lider/img/'
    if (move_uploaded_file($file['tmp_name'], '../'.$pasta.'/'.$imagemNome)) {
      return $imagemNome;
    }else {
      return false;
    }
  }
  public static function uploadFile($file, $pasta){
    $formatoArquivo = explode('.', $file['name']);
    $imagemNome = date('Y-m-d').uniqid().'.'.$formatoArquivo[count($formatoArquivo)-1];
    //'C://xampp/htdocs/lider/img/'
    if (move_uploaded_file($file['tmp_name'], BASE_DIR_PATH.$pasta.'/'.$imagemNome)) {
      return $imagemNome;
    }else {
      return false;
    }
  }
  public static function deleteFile($file,$pasta){
    unlink(BASE_DIR_PATH.$pasta.'/'.$file);
  }


  public static function verificaCampos($campos,$nomecampo){
    $continuar = true;
    $campo = $campos;
    if ($campo == '' || $campo == 0) {
      Gerenciador::alert('danger', 'O campo <strong>'.$nomecampo.'</strong> está vázio! Atualize a página e tente novamente.');
      die();
    }
  }

  public static function insert($arr){
    $certo = true;
    $nome_tabela = $arr['nome_tabela'];
    $query = "INSERT INTO `$nome_tabela` VALUES (null";
    foreach ($arr as $key => $value) {
      $nome = $key;
      $valor = $value;
      if ($nome == 'acao' || $nome=='nome_tabela')
        continue;
      if ($value == '') {
        $certo = false;
        break;
      }
      $query.=",?";
      $parametros[] = $value;
    }
    $query.=")";
    if ($certo == true) {
      $sql=MySql::conectar()->prepare($query);
      $sql->execute($parametros);
    }
    return $certo;
  }

  public static function insertFields($arr){
    $certo = true;
    $nomeTabela = $arr['nomeTabela'];
    //pega os campos do array;
    //é necessario declarar o nome do CAMPO id;
    $campos = '('.$arr['idTabela'];
    foreach ($arr as $key => $value) {
      if($key=='nomeTabela' || $key=='idTabela' || $key=='acao') continue;
      $campos.=','.$key;
    }
    $campos.=')';
    $query = "INSERT INTO `$nomeTabela` $campos VALUES (null";
    foreach ($arr as $key => $value) {
      //$nome = $key;
      $valor = $value;
      if($key=='nomeTabela' || $key=='idTabela' || $key=='acao') continue;
      /*if ($value == '') {
        $certo = false;
        break;
      }*/
      $query.=",?";
      $parametros[] = $value;
    }
    $query.=")";
    //var_dump($parametros);
    //echo $query;
    if ($certo == true) {
      $sql=MySql::conectar()->prepare($query);
      if($sql->execute($parametros)==false)
        $certo=false;
    }
    return $certo;
  }

  public static function update($arr){
    $certo = true;
    $first = false;
    $nomeTabela = $arr['nomeTabela'];
    $id = $arr['idTabela'];
    $query = "UPDATE `$nomeTabela` SET ";
    foreach ($arr as $key => $value) {
      $nome = $key;
      $valor = $value;
      if ($nome == 'atualizar' || $nome=='nomeTabela' || $nome=='idTabela')
        continue;
      /*if ($value == '') {
        $certo = false;
        break;
      }*/
      if ($first == false) {
        $first = true;
        $query.="$nome=?";
      }else{
        $query.=",$nome=?";
      }
      $parametros[] = $value;
    }
    if ($certo == true) {
      $parametros[] = $arr[$id];
      $sql=MySql::conectar()->prepare($query.' WHERE '.$id.'=?');
      /*else if ($nome=='idartigo') {
        $parametros[] = $arr['idartigo'];
        $sql=MySql::conectar()->prepare($query.'WHERE idartigo=?');
      }*/
      $sql->execute($parametros);
    }
    //echo '<pre>'; var_dump($parametros); echo '</pre><br>';
    //echo '<pre>'; var_dump($query); echo '</pre><br>';
    if($certo==false) echo '<h1>ERRO</h1>';
    return $certo;
  }

  public static function selectTudoCampos($campos, $tabela, $onde=null, $inicio=null, $fim=null){
    //$campos = ---- 'camp1, camp2, camp3' ---- campos do sql
    if ($onde==null) $onde='';
    if ($inicio==null && $fim == null) 
      $sentenca="SELECT $campos FROM $tabela $onde";
    else
      $sentenca="SELECT $campos FROM $tabela $onde LIMIT $inicio, $fim";
    $sql = MySql::conectar()->prepare($sentenca);
    $sql->execute();
    return $sql->fetchAll();
  }

  public static function deletarRegistro($tabela, $parametro, $id=false){
    if ($id!=false && $parametro!='') {
      $sql = MySql::conectar()->prepare("DELETE FROM `$tabela` WHERE $parametro = $id");
      
    }
    $sql->execute();
  }
  public static function redirect($url){
    echo "<script>location.href='".$url."'</script>";
    die();
  }
  /*
  METODO PARA SELECIONAR UM REGISTRO 
  */
  public static function select($tabela, $query, $arr, $grupo = null){
    if ($grupo == null) {
      $grupo='';
    }
    $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` $grupo WHERE $query");
    $sql->execute($arr);
    return $sql->fetch();
  }
  public static function selectCampos($campos, $tabela, $query, $arr, $grupo = null){
    if ($grupo == null) {
      $grupo='';
    }
    $sql = MySql::conectar()->prepare("SELECT $campos FROM `$tabela` $grupo WHERE $query");
    $sql->execute($arr);
    return $sql->fetch();
  }
}

?>