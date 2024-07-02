<?php include('../../config.php');
error_reporting(E_ALL);
  ini_set("display_errors", 0);
  if (isset($_GET['loggout'])) {
    Gerenciador::loggout();
  }
?>
<?php
$idrelatorio = (int)$_GET['rel'];
$relatorio=Gerenciador::select('relatorios', 'idrelatorio=?', array($idrelatorio));
if(isset($relatorio['sentenca'])){
  $sentenca = Relatorios::selectRelatorio($relatorio['sentenca']);
  $campos=explode(',',$relatorio['campos']);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title><?php echo TITULO ?></title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="<?php echo WWW?>assets/css/style.css">
  <link rel="icon" type="image/png" href="<?php echo WWW?>img/unlock.png">
  <link href="<?php echo WWW?>assets/icons/css/all.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body class="bg-body">
<?php if (empty($_SESSION['login']) || $_SESSION['login']==false) {
  die('Logue no sistema para ter acesso a essa página');
  } ?>
<div class="container">
  <div class="row">
    <div class="col-md-12 mt-2">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo WWW; ?>">Home</a></li>
          <?php if($_SESSION['perfil']==1){ ?>
            <li class="breadcrumb-item"><a href="<?php echo WWW; ?>relatorios/relatorio">Relatório</a></li>
          <?php } ?>
          <li class="breadcrumb-item active" aria-current="page">Visualizar relatório</li>
        </ol>
      </nav>
    </div><!-- End .col-md-6 -->
  </div><!-- End .row -->
  <div class="row">
    <div class="col-md-12 mt-2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?php echo $relatorio['titulo']; ?></h5>
          <h6 class="card-subtitle mb-2 text-muted">
            Total de registros: <span class="badge rounded-pill bg-info text-dark"><?php echo count($sentenca); ?></span>
          </h6>
          <div class="table-responsive">
            <div id="dvData">
              <table class="table table-hover table-striped" id="tableexportada">
                <thead>
                  <tr>
                    <?php for ($i = 0; $i < count($campos); $i++) { ?>
                      <th><?php echo $campos[$i]; ?></th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody id="pesquisa">
                  <?php foreach ($sentenca as $key => $value) { ?>
                    <tr>
                      <?php for ($i=0; $i < count($campos); $i++) { ?>
                        <td style="text-transform: uppercase;"><?php echo strtoupper(trataNumero($value[$i])); ?></td>
                      <?php } ?>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div><!-- End .card-body -->
          </div>
        </div><!-- End table-responsive -->
      </div>
    </div><!-- End col-md-12 -->
  </div><!-- End .row -->
</div><!-- End .container -->

<script type="text/javascript">
  $(document).ready(function () {
    
    var tableGeral = $('#tableexportada').DataTable({
      "lengthChange": false,
      "pageLength": -1,
      /*,
      lengthMenu: [
            [10, 20, 40, 100, -1],
            [10, 20, 40, 100, 'Tudo'],
        ],*/
      buttons:[
      //'copy', 'csv', 'excel', 'pdf', 'print',
      { extend: 'copy', footer: true },
      { extend: 'excel', footer: true },
      { extend: 'csv', footer: true },
      { extend: 'pdf', footer: true },
      { extend: 'print', footer: true }
      ],
      "language": {
            "lengthMenu": "Mostrar Linhas _MENU_",
            "zeroRecords": "Nada encontrado - desculpe",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "Não há registros disponíveis",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search":         "Buscar:",
            "paginate": {
                "first":      "Primeiro",
                "last":       "Último",
                "next":       "Próximo",
                "previous":   "Anterior"
            }
        }
    });
    
    tableGeral.buttons().container().appendTo('#tableexportada_wrapper .col-md-6:eq(0)');
});
</script>
  <script src="<?php echo WWW?>assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo WWW?>assets/DataTable/datatables.min.js"></script>
  <script type="text/javascript" src="<?php echo WWW?>assets/DataTable/pdfmake.min.js"></script>
  <script type="text/javascript" src="<?php echo WWW?>assets/DataTable/vfs_fonts.js"></script>

</body>
</html>