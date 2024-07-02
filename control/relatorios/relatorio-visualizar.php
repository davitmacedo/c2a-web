<?php
$idrelatorio = (int)$_GET['rel'];
$relatorio=Gerenciador::select('relatorios', 'idrelatorio=?', array($idrelatorio));
if(isset($relatorio['sentenca'])){
  $sentenca = Relatorios::selectRelatorio($relatorio['sentenca']);
  $campos=explode(',',$relatorio['campos']);
}
if(empty($sentenca)){
  Gerenciador::alert('warning','Nenhum relatório encontrado. <a href="relatorios/relatorio">Retornar</a>');
  die();
}
?>