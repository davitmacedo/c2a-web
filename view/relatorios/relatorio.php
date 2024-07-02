<?php if ($_SESSION['login']==false) {include('../inc/verifica-login.php');} ?>
<div class="container">
  <div class="row">
    <div class="col-md-12 mt-2">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo WWW; ?>"><i class="fa-solid fa-house"></i></a></li>
          <li class="breadcrumb-item active" aria-current="page">Relatórios</li>
        </ol>
      </nav>
    </div><!-- End .col-md-6 -->
  </div><!-- End .row -->
  <div class="row">
    <div class="col-6">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adicionarRelatorio">
        <i class="fas fa-plus"></i> RELATÓRIO
      </button>
      <!-- Modal -->
      <div class="modal fade" id="adicionarRelatorio" tabindex="-1" aria-labelledby="adicionarRelatorioLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content bg-card">
            <div class="modal-header">
              <h5 class="modal-title" id="adicionarRelatorioLabel">Adicionar Relatório</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
              <div class="modal-body">
                <fieldset>
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" required="true" value="<?php echo recoveryPost('titulo'); ?>">
                      <label for="titulo">Título</label>
                    </div>
                  </div><!-- End .col-12 -->
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="campos" name="campos" placeholder="Campos" required="true" value="<?php echo recoveryPost('campos'); ?>">
                      <label for="campos">Campos</label>
                    </div>
                  </div><!-- End .col-12 -->
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <textarea class="form-control" name="sentenca" placeholder="Senten&ccedil;a" id="sentenca" required="true" style="height: 300px"><?php echo recoveryPost('sentenca'); ?></textarea>
                      <label for="sentenca">Senten&ccedil;a</label>
                    </div>
                  </div><!-- End .col-6 -->
                  <input type="hidden" name="nome_tabela" value="relatorios">
                </fieldset>
              </div><!-- End modal-body -->
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <input type="submit" class="btn btn-primary" value="Salvar" name="acao">
              </div><!-- End modal-footer -->
            </form>
          </div><!-- End modal-content -->
        </div><!-- End modal-dialog -->
      </div><!-- End modal -->
    </div><!-- End col-12 -->
    <div class="col-6 offset-md-3 mt-3">
      <input id="buscar" type="text" class="form-control border" placeholder="Pesquisar">
    </div><!-- End .col-md-6 -->
    <div class="col-12 mt-2">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover table-sm text-center mt-2">
          <thead>
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">A&Ccedil;&Atilde;O</th>
            </tr>
          </thead>
          <tbody id="pesquisa">
            <?php foreach ($relatorios as $key => $value): ?>
              <tr>
                <td><?php echo $value['titulo']; ?></td>
                <td>
                  <a href="relatorio-visualizar?rel=<?php echo $value['idrelatorio'] ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                  <a href="" data-bs-toggle="modal" data-bs-target="#editar<?php echo $value['idrelatorio']; ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                  <a href="<?php echo "relatorio?delete=" . $value['idrelatorio']; ?>" actionBtn="delete" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                </td>
              </tr>

              <!-- Modal -->
              <div class="modal fade" id="editar<?php echo $value['idrelatorio']; ?>" tabindex="-1" aria-labelledby="editar<?php echo $value['idrelatorio']; ?>Label" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editar<?php echo $value['idrelatorio']; ?>Label"><?php echo $value['titulo'] ?></h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                      <div class="modal-body">
                      <fieldset>
                        <div class="col-12">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" required="true" value="<?php echo $value['titulo']; ?>">
                            <label for="titulo">Título</label>
                          </div>
                        </div><!-- End .col-12 -->
                        <div class="col-12">
                          <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="campos<?php echo $value['idrelatorio']; ?>" name="campos" placeholder="Campos" required="true" value="<?php echo $value['campos']; ?>">
                            <label for="campos">Campos</label>
                          </div>
                        </div><!-- End .col-12 -->
                        <div class="col-12">
                          <div class="form-floating mb-3">
                            <textarea class="form-control" name="sentenca" placeholder="Senten&ccedil;a" id="sentenca" required="true" style="height: 300px"><?php echo $value['sentenca']; ?></textarea>
                            <label for="sentenca">Senten&ccedil;a</label>
                          </div>
                        </div><!-- End .col-6 -->
                        <input type="hidden" name="id" value="<?php echo $value['idrelatorio']; ?>">
                      </fieldset>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" name="alterar">Alterar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div><!-- End Modal -->
            <?php endforeach ?>
            
          </tbody>
        </table>
      </div><!-- End table-responsive -->
    </div><!-- End col-md-12 -->
  </div><!-- End .row -->
</div><!-- End .container -->