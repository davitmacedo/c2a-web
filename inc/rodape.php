  <a href="#top" id="scroll-top" title="Volta ao topo">
    <i class="fas fa-angle-up"></i>
  </a>
  <script>
  $(document).ready(function(){
    $("#buscar").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#pesquisa tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
    });
    $(document).scroll(function(){
      if($(window).scrollTop()>300) {
        if($('#scroll-top').attr('class')!='fixed'){
          $('#scroll-top').addClass('fixed');
        } 
      }else{
        if($('#scroll-top').hasClass('fixed')){
          $('#scroll-top').removeClass('fixed');
        }
      }
    });
    $("a[href='#top']").click(function() {
      $("html, body").animate({ scrollTop: 0 }, "slow");
      return false;
    });
  });
  </script>
  
  <script type="text/javascript" src="<?php echo WWW?>assets/DataTable/datatables.min.js"></script>
  <script type="text/javascript" src="<?php echo WWW?>assets/DataTable/pdfmake.min.js"></script>
  <script type="text/javascript" src="<?php echo WWW?>assets/DataTable/vfs_fonts.js"></script>
  <?php if(isset($_GET['id'])){ ?>
  <script type="text/javascript">
    $('html, body').animate({
      scrollTop: $("#<?php echo $_GET['id']; ?>").offset().top
    }, 500);
  </script>
  <?php } ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  <script src="assets/js/jquery.maskedinput.js"></script>
</body>
</html>