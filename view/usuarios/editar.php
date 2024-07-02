<div class="container">
  <div class="row">
    <div class="col-md-12 mt-2">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo WWW; ?>"><i class="fa-solid fa-house"></i></a></li>
        <li class="breadcrumb-item"><a href="<?php echo WWW; ?>usuarios/listar">Listar Usuários</a></li>
          <li class="breadcrumb-item active" aria-current="page"><i class="fa-solid fa-wrench"></i></li>
        </ol>
      </nav>
    </div><!-- End .col-md-12 -->
  </div><!-- End .row -->
  <div class="row">
    <div class="col-md-4 mx-auto mt-2">
      <div class="card bg-card">
        <div class="card-body">
          <form action="" method="post">
            <div class="input-group mb-3">
              <span class="input-group-text" id="nome">Nome*</span>
              <input type="text" class="form-control" aria-label="Nome" aria-describedby="Nome" name="nome" required value="<?=$usuario['nome'];?>">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" id="usuario">Usuário*</span>
              <input type="text" class="form-control" aria-label="Usuário" aria-describedby="Usuário" name="usuario" required value="<?=$usuario['usuario'];?>">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" id="senha">Nova Senha</span>
              <input type="password" class="form-control" aria-label="Senha" aria-describedby="Senha" name="nova-senha">
              <input type="hidden" name="senha" value="<?=$usuario['senha'];?>">
            </div>
            <select class="form-select" name="perfil" required>
              <option value="">Selecione um perfil</option>
              <option value="1" <?php if($usuario['perfis_idperfil']==1) echo 'selected' ?>>Administrador</option>
              <option value="2" <?php if($usuario['perfis_idperfil']==2) echo 'selected' ?>>Padrão</option>
            </select>
            <input type="hidden" name="idusuario" value="<?=$usuario['idusuario'];?>">
            <input type="hidden" name="atualizar" value="1">
            <button type="submit" class="btn btn-success btn-sm mt-2">Atualizar</button>
          </form>
        </div><!-- End .card-body -->
      </div><!-- End .card -->
    </div><!-- End .col-md-4 -->
  </div><!-- End .row -->
</div><!-- End .container-->