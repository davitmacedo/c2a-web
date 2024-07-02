<?php 
$id=(int)$_GET['id'];
$usuario = Selecao::select('SELECT * FROM usuarios WHERE idusuario=?', array($id));
if(empty($usuario)){
  Gerenciador::alert('warning', 'Nenhum usuário encontrado.');
  die();
}
if(isset($_POST['atualizar'])){
  $idusuario = (string)$_POST['idusuario'];
  $nome = (string)$_POST['nome'];
  $usuario = (string)$_POST['usuario'];
  $perfil = (string)$_POST['perfil'];
  $senha = (empty($_POST['nova-senha'])) ? (string)$_POST['senha'] : md5((string)$_POST['nova-senha']);
  $arr = array('idTabela'=>'idusuario', 'idusuario'=>$idusuario, 'nomeTabela'=>'usuarios', 'nome'=>$nome, 'usuario'=>$usuario, 'senha'=>$senha, 'perfis_idperfil'=>$perfil);
  if(Gerenciador::update($arr)==true){
    Gerenciador::alert('success', 'Registro atualizado com sucesso.');
    echo '<META http-equiv="refresh" content="2;">';
    die();
  }else{
    Gerenciador::alert('danger', 'Erro ao atualizar registro.');
  }
}