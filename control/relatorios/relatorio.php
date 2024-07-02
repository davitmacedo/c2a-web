<?php 
if(isset($_POST['acao'])){
  $_POST['titulo']=$_POST['titulo'];
  $_POST['campos']=$_POST['campos'];
  if(Gerenciador::insert($_POST)){
    Gerenciador::alert('success', 'Registro inserido com sucesso.');
    echo '<META http-equiv="refresh" content="0;">';
    die();
  }else{
    Gerenciador::alert('error', 'Ocorreu um erro ao inserir registro.');
  }
}
if(isset($_GET['delete'])){
  $idExcluir = intval($_GET['delete']);
  if(Gerenciador::deletarRegistro('relatorios', 'idrelatorio', $idExcluir)){
    Gerenciador::alert('warning', 'Registro deletado com sucesso.');
    echo '<META http-equiv="refresh" content="3;relatorio">';
    die();
  }else{
    Gerenciador::alert('danger', 'Ocorreu um erro ao deletar registro.');
  }
}

if(isset($_POST['alterar'])){
  $id=(int)$_POST['id'];
  $titulo=$_POST['titulo'];
  $campos=$_POST['campos'];
  $sentenca=$_POST['sentenca'];
  $arr = array('idrelatorio'=>$id,'titulo'=>$titulo, 'campos'=>$campos, 'sentenca'=>$sentenca, 'nome_tabela'=>'relatorios', 'idTabela'=>'idrelatorio');
  if(Gerenciador::update($arr)){
    Gerenciador::alert('success', 'Registro atualizado com sucesso.');
    echo '<META http-equiv="refresh" content="0;">';
    die();
  }else{
    Gerenciador::alert('danger', 'Ocorreu um erro ao atualizar registro.');
  }
}
$relatorios=Selecao::selectTudoTabela('relatorios', 'ORDER BY idrelatorio DESC');
?>