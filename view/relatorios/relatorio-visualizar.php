<?php if ($_SESSION['login']==false) {include('../inc/verifica-login.php');} ?>
<div class="container">
  <div class="row">
    <div class="col-md-12 mt-2">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo WWW; ?>"><i class="fa-solid fa-house"></i></a></li>
          <li class="breadcrumb-item"><a href="<?php echo WWW; ?>?url=relatorio">Relatórios</a></li>
          <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-eye"></i> Relatório</li>
        </ol>
      </nav>
    </div><!-- End .col-md-6 -->
  </div><!-- End .row -->
  <div class="row">
    <div class="col-6 offset-md-3 mt-3">
      <input id="buscar" type="text" class="form-control border" placeholder="Pesquisar">
    </div><!-- End .col-md-6 -->
    <div class="col-md-12 mt-2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?php echo $relatorio['titulo']; ?></h5>
          <h6 class="card-subtitle mb-2 text-muted">
            Total de registros: <span class="badge rounded-pill bg-info text-dark"><?php echo count($sentenca); ?></span>
          </h6>
          <a href="../view/relatorios/export.php?rel=<?php echo $_GET['rel'] ?>" target="_blank" class="btn btn-secondary">Excel</a>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <?php //var_dump($campos); ?>
                  <?php for ($i = 0; $i < count($campos); $i++) { ?>
                    <th><?php echo $campos[$i]; ?></th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody id="pesquisa">
                <?php foreach ($sentenca as $key => $value) { ?>
                <tr>
                    <?php for ($i=0; $i < count($campos); $i++) { ?>
                      <td><?php echo trataNumero($value[$i]); ?></td>
                    <?php } ?>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div><!-- End table-responsive -->
        </div><!-- End card-body -->
      </div><!-- End card -->
    </div><!-- End col-md-12 -->
  </div><!-- End .row -->
</div><!-- End .container -->