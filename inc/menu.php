<?php 
  if (isset($_GET['loggout'])) {
    Gerenciador::loggout();
  }
?>
<!DOCTYPE html>
<html lang="pt" data-bs-theme="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title><?php echo TITULO; ?></title>
  <!-- CSS only -->
  <link rel="stylesheet" type="text/css" href="<?php echo WWW?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo WWW?>assets/css/style.css">
  <link rel="icon" type="image/png" href="<?php echo WWW?>img/unlock.png">
  <link href="<?php echo WWW ?>assets/icons/css/all.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/editor/ckeditor.js"></script>
  <script src="assets/js/chart.js"></script>

</head>
<body class="bg-body">
  <div class="alert-msg" style="display:none"></div>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-card">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo WWW;?>">C2A ADM</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropTotal" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                USUÁRIOS
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropTotal">
                <li><a class="dropdown-item" href="<?php echo WWW; ?>usuarios/listar">LISTAR</a></li>
              </ul>
            </li>
            <!-- <li class="nav-item"><a class="nav-link" href="<?php //echo WWW;?>?url=busca"><i class="fas fa-search"></i></a></li> -->
          </ul>
          <ul class="navbar-nav ms-md-auto">
            <?php /*<li class="nav-item">
              <form class="d-flex" role="search">
                <input type="hidden" name="url" value="busca">
                <input class="form-control me-2" type="search" name="user" placeholder="Busca" aria-label="Pesquisar"> 
                <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
              </form>
            </li>*/ ?>
            <li class="nav-item"><a class="nav-link" href="<?php echo WWW;?>"><?php echo $_SESSION['nome'] ?></a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo WWW;?>?loggout">Sair</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>