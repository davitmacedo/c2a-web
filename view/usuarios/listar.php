<div class="container">
  <div class="row">
    <div class="col-md-12 mt-2">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo WWW; ?>"><i class="fa-solid fa-house"></i></a></li>
          <li class="breadcrumb-item active" aria-current="page">Lista de Usuários</li>
        </ol>
      </nav>
    </div><!-- End .col-md-12 -->
  </div><!-- End .row -->
  <div class="row">
    <div class="col-md-12 mt-2">
      <div class="card bg-card">
        <div class="card-body">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-success btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#criarUsuario" title="Adicionar novo usuário">
            <i class="fa-solid fa-user-plus"></i> Usuário
          </button>          
          <div class="table-responsive">
            <table class="table align-middle table-striped table-bordered table-hover table-sm text-center">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Usuário</th>
                  <th>Perfil</th>
                  <th><i class="fa-solid fa-gear"></i></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($usuarios as $key => $usuario){ ?>
                  <tr>
                    <th><?= $usuario['nome'] ?></th>
                    <th><?= $usuario['usuario'] ?></th>
                    <th><?= $usuario['perfil'] ?></th>
                    <th>
                      <a href="editar?id=<?= $usuario['idusuario'] ?>" title="Editar">
                        <i class="fa-solid fa-wrench"></i>
                      </a>
                    </th>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div><!-- End .table-responsive -->
        </div><!-- End .card-body -->
      </div><!-- End .card -->
    </div><!-- End .col-md-12 -->
  </div><!-- End .row -->
  <!-- Modal -->
  <div class="modal fade" id="criarUsuario" tabindex="-1" aria-labelledby="criarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-card">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="criarUsuarioLabel"><i class="fa-solid fa-user-plus"></i>  Novo Usuário</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="input-group mb-3">
              <span class="input-group-text" id="nome">Nome</span>
              <input type="text" class="form-control" aria-label="Nome" aria-describedby="Nome" name="nome" required>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" id="usuario">Usuário</span>
              <input type="text" class="form-control" aria-label="Usuário" aria-describedby="Usuário" name="usuario" required>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" id="senha">Senha</span>
              <input type="password" class="form-control" aria-label="Senha" aria-describedby="Senha" name="senha" required>
            </div>
            <select class="form-select" name="perfil" required>
              <option value="">Selecione um perfil</option>
              <option value="1">Administrado</option>
              <option value="2">Padrão</option>
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <input type="hidden" name="adicionar" value="1">
          </div>
        </form>
      </div>
    </div>
  </div>
</div><!-- End .container-->