 <?php /*ini_set('display_errors', 1);
error_reporting(E_ALL);*/
  include('config.php');
  if (Gerenciador::logado()==false) {
    include('login.php');
  }else{
      $url = isset($_GET['url']) ? $_GET['url'] : 'home';
    $urlVar = explode('/', $url);
    include('inc/menu.php'); 
    if(file_exists('view/'.$url.'.php')){
      if(file_exists('control/'.$url.'.php')) include('control/'.$url.'.php');
      include('view/'.$url.'.php');
    }else{
      include('view/404.php');
    }
    include('inc/rodape.php');
   }
 ?>