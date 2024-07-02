<?php
class Selecao{
  public static function select($select, $arr){
    $verifica = explode(' ', $select);
    if($verifica[0]=='SELECT'){
      $sql = MySql::conectar()->prepare($select);
      $sql->execute($arr);
      $retorno=$sql->fetch();
    }else{
      $retorno=array(0 => 'ERRO com a sentença. Ela precisa ser um SELECT.');
    }

    return $retorno;
  }

  public static function selectTudo($select){
    $verifica = explode(' ', $select);
    //echo $select.'<br>';
    if($verifica[0]=='SELECT'){
      $sql = MySql::conectar()->query($select);
      $retorno=$sql->fetchAll();
    }else
    if($verifica[0]==''){
      $retorno= array(0 => 'Parâmetro vazio.');
    }else{
      $retorno= array(0 => 'Senteça inválida.');
    }
      return $retorno;
  }
  
  public static function selectTudoTabela($tabela, $onde=null, $inicio=null, $fim=null){
    if ($onde==null) $onde='';
    if ($inicio==null && $fim == null) 
      $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` $onde");
    else
      $sql = MySql::conectar()->prepare("SELECT * FROM `$tabela` $onde LIMIT $inicio, $fim");
    
    
    $sql->execute();
    return $sql->fetchAll();
  }
}



?>