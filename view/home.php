<div class="container">
  <div class="row">
    <div class="col-md-12 mt-2">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active"><i class="fa-solid fa-house"></i></li>
        </ol>
      </nav>
    </div><!-- End .col-md-12 -->
  </div><!-- End .row -->
  <div class="row">
    <div class="col-md-12 mt-2">
      <div class="card">
        <div class="card-body">       
          <div class="table-responsive">
            <table class="table align-middle table-striped table-bordered table-hover table-sm text-center mt-2" id="geral">
              <thead>
                <tr>
                  <th>CÓDIGO</th>
                  <th>MODELO</th>
                  <th>PARTNUMB</th>
                  <th>ESTOQUE ATUAL</th>
                </tr>
              </thead>
              <tbody iid="pesquisar">
                <?php foreach($produtos as $key => $dado){ ?>
                  <tr>
                    <td><?= $dado['TB01010_CODIGO'] ?></td>
                    <td><?= $dado['TB01010_NOME'] ?></td>
                    <td><?= $dado['TB01010_REFERENCIA'] ?></td>
                    <td><?= trataNumero($dado['TB02001_QTPROD_U']) ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div><!-- End .table-responsive -->
        </div><!-- End .card-body -->
      </div><!-- End .card -->
    </div><!-- End .col-md-12 -->
  </div><!-- End .row -->
</div><!-- End .container-->
<script type="text/javascript">
  $(document).ready(function () {
    var tableGeral = $('#geral').DataTable({
      "pageLength": 150,
      lengthMenu: [
            [10, 20, 40, 100, 125, 150, -1],
            [10, 20, 40, 100, 125, 150, 'Tudo'],
        ],
      buttons:['copy', 'csv', 'excel', 'pdf', 'print'],
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
    
    tableGeral.buttons().container().appendTo('#geral_wrapper .col-md-6:eq(0)');
  });
</script>