<?php
class Relatorios{
  public static function selectRelatorio($value){
    $verifica = explode(' ', $value);
    if($verifica[0]=='SELECT'){
      $sql = MySql::conectar()->query($value);
      $retorno=$sql->fetchAll();
    }else{
      $retorno= array(0 => 'ERRO com a sentença. Ela precisa ser um SELECT.');;
    }

      return $retorno;
  }
}

?>