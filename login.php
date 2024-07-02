<?php
if(isset($_POST['url']))$url=$_POST['url']; else $url='';
if (isset($_COOKIE['lembrar'])) {
  /*
  VERIFICA SE O COOKIE lembrar FOI SELECIONADO E LEMBRA DA SESSAO
  */
  $usuario = $_COOKIE['usuario'];
  $password = $_COOKIE['senha'];
  $sql = MySql::conectar()->prepare("SELECT * FROM `usuarios` WHERE usuario = ? and senha = ?");
  $sql->execute(array($usuario,$password));
  if($sql->rowCount() == 1){
    $info = $sql->fetch();
    $_SESSION['login'] = true;
    $_SESSION['usuario'] = $usuario;
    $_SESSION['senha'] = $password;
    $_SESSION['perfil'] = $info['perfis_idperfil'];
    $_SESSION['nome']  = $info['nome'];
    //para as duplas de professores
    //if(!empty($info['grupo'])) $_SESSION['grupo'] = $info['grupo'];
    header('Location:'.WWW.$url);
    die();
  }
}
// Gerar um token CSRF seguro
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Login</title>
  <!-- CSS only -->
  <link rel="stylesheet" type="text/css" href="<?php echo WWW?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo WWW?>assets/css/style.css">
  <link rel="icon" type="image/png" href="<?php echo WWW?>img/icon.png">
</head>
<body class="d-flex align-items-center py-4 bg-body">
  <div class="container">
    <div class="row">
      <main class="form-signin w-100 m-auto">
        <div class="card bg-card">
          <div class="card-body">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Login</button>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                <?php
                  if (isset($_POST['entrar'])) {
                    if(!isset($_POST['csrf_token'])) die('Token CSRF não encontrado.');
                    // Verificar o token CSRF
                    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                      die('Token CSRF inválido.');
                    }
                    $usuario = $_POST['usuario'];
                    $password = md5($_POST['senha']);
                    $sql = MySql::conectar()->prepare("SELECT * FROM `usuarios` WHERE usuario = ? and senha = ?");
                    $sql->execute(array($usuario,$password));
                    if($sql->rowCount() == 1){
                      $info = $sql->fetch();
                      $_SESSION['login'] = true;
                      $_SESSION['usuario'] = $usuario;
                      $_SESSION['senha'] = $password;
                      $_SESSION['perfil'] = $info['perfis_idperfil'];
                      
                      $_SESSION['nome']  = $info['nome'];
                      //para as duplas de professores
                      //if(!empty($info['grupo'])) $_SESSION['grupo'] = $info['grupo'];

                      if (isset($_POST['lembrar'])) {
                        setcookie('lembrar', true, time()+60*60*24*30,'/');
                        setcookie('usuario', $usuario, time()+60*60*24*30,'/');
                        setcookie('senha', $password, time()+60*60*24*30,'/');
                      }
                      header('Location:'.WWW.$url);
                      die();
                    }else{
                      echo "<div class='alert alert-danger alert-dismissable'>
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                      <strong>Erro</strong> ao efetuar o login!
                      </div>";
                    }
                  }
                  ?>
                <form id="logar" method="post">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="USU&Aacute;RIO">
                    <label class="text-white" for="usuario">USU&Aacute;RIO</label>
                  </div><!-- End .form-floating -->
                  <div class="form-floating">
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="senha">
                    <label class="text-white" for="senha">SENHA</label>
                  </div><!-- End .form-floating -->
                  <div class="mt-3 form-check">
                    <input type="checkbox" class="form-check-input" id="lembrar" name="lembrar">
                    <label class="form-check-label text-white" for="lembrar">Mantenha-me conectado</label>
                  </div>
                  <div class=" my-3">
                    <input type="submit" name="entrar" value="Entrar" class="btn btn-primary">
                  </div>
                  <input type="hidden" name="url" value="<?php if(!empty($_GET['url'])) idUrl($_GET); ?>">
                  <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                </form><!-- End form -->
              </div><!-- End .card-body-->
            </div>
          </div>
        </div><!-- End .card -->
      </main><!-- End col-md-4 -->
    </div><!-- End .row -->
  </div><!-- End .container -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>