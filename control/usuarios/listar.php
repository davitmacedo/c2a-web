<?php
if($_SESSION['perfil']!=1) {
  Gerenciador::alert('warning', 'Seu perfil não tem permissão para acessar essa página.');
  die();
}
$usuarios = Selecao::selectTudoTabela('usuarios', 'INNER JOIN perfis on idperfil=perfis_idperfil');
if(isset($_POST['adicionar'])){
  $nome=(string)$_POST['nome'];
  $usuario=(string)$_POST['usuario'];
  $senha=md5($_POST['senha']);
  if(!empty($usuario) && !empty($nome) && !empty($senha)){
    
    $perfil= (empty((int)$_POST['perfil'])) ? 2 : (int)$_POST['perfil'];
    $select=Selecao::select('SELECT idusuario FROM usuarios a WHERE usuario=?', array($usuario));
    if(empty($select['idusuario'])){
      $arr = array('idTabela'=>'idusuario', 'nomeTabela'=>'usuarios', 'nome'=>$nome, 'usuario'=>$usuario, 'senha'=>$senha, 'perfis_idperfil'=>$perfil);
        if(Gerenciador::insertFields($arr)==true){
          Gerenciador::alert('success', 'Registro inserido com sucesso.');
          echo '<META http-equiv="refresh" content="0;">';
          die();
        }
    }else{
      Gerenciador::alert('warning', 'Atenção: usuário já existe no sistema.');
    }
  }else{
    Gerenciador::alert('warning', 'Atenção: todos os campos são obrigatórios.');
  }
}