<?php
// Configurações do banco de dados
$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco_de_dados = 'c2a';
    

try {
    // Conectar ao banco de dados usando PDO
    $conexao = new PDO("mysql:host=$servidor;dbname=$banco_de_dados", $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Definir o cabeçalho de resposta como JSON
    header('Content-Type: application/json');

    // Verificar o tipo de solicitação HTTP
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Lógica para manipular solicitações GET
        if(isset($_GET['serie'])){
            //resultado
            $sql = $conexao->prepare("SELECT * FROM TB02055 T1 INNER JOIN TB02002 T2 ON TB02002_CODIGO = TB02055_CODIGO WHERE TB02055_NUMSERIE LIKE :data AND TB02055_OPERACAO LIKE 'E' AND TB02002_CODFOR LIKE '21' LIMIT 20");
            $data = '%' . $_GET['serie'] . '%';
            $sql->execute(array(':data' => $data));
            $retorno = $sql->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($retorno);
        }else if (isset($_GET['id'])) {
            //detail
            $sql = $conexao->prepare("SELECT * FROM TB02055 T1 INNER JOIN TB02002 T2 ON TB02002_CODIGO = TB02055_CODIGO WHERE /*TB02055_NUMSERIE=:data*/ T1.id=:data AND TB02055_OPERACAO LIKE 'E'LIMIT 1");
            $sql->execute(array(':data' => $_GET['id']));
            $retorno = $sql->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($retorno);
        }else if(isset($_GET['load'])){
            //index
            $sql = $conexao->prepare("SELECT TB02021_NTFISC, TB02021_DATA FROM `TB02055` INNER JOIN `TB02021` ON TB02021_CODIGO=TB02055_CODIGO WHERE TB02055_OPERACAO LIKE 'S' AND TB02055_NUMSERIE=:data ORDER BY TB02055_DTVALIDADE DESC LIMIT 1");
            $data = $_GET['load'];
            $sql->execute(array(':data' => $data));
            $retorno = $sql->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($retorno);
        }
        
        
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lógica para manipular solicitações POST
        // Exemplo de lógica para inserir dados no banco de dados
        /*
        $dados = json_decode(file_get_contents('php://input'), true);
        $stmt = $conexao->prepare('INSERT INTO tabela (campo1, campo2) VALUES (:campo1, :campo2)');
        $stmt->bindParam(':campo1', $dados['campo1']);
        $stmt->bindParam(':campo2', $dados['campo2']);
        $stmt->execute();
        echo json_encode(array('mensagem' => 'Dados inseridos com sucesso'));
        */
    } else {
        // Método não permitido
        http_response_code(405);
        echo json_encode(array('erro' => 'Método não permitido'));
    }
} catch (PDOException $e) {
    // Erro ao conectar ao banco de dados
    echo json_encode(array('erro' => 'Erro de conexão: ' . $e->getMessage()));
}
/*select TB02055_produto, TB02055_numserie, TB02055_codigo, TB02055_operacao, TB02055_nomefor, TB02055_opcad, TB02002_dtcad, TB02002_data, TB02002_ntfisc, TB02002_qtde, TB02002_dtentrada  from TB02055, TB02002
  where tb02002_codigo = tb02055_codigo
  and  tb02055_numserie in ('SCAB231290039', 'SCAB222940319', 'SCAB21306477D', 'SCAB220031DB0', 'SCAB221462DA3', 'SCAB212645D5E', 'SCAB1724400F4', 'SCAB22193303E', 'SCAB172470FD3',
  'SCAS173320375', 'SCAB21250560D', 'SCAB212505716', 'SCAB190491A6C', 'SCAB222620DA6', 'SCAB2312900B4', 'SCAD203450F0E', 'SCAB2023101FC', 'SCAB221932FA1', 'SCAB22147119A', 'SCAB220031DC7',
  'SCAB2307411D4', 'SCAB220031CA7', 'SCAB220040854', 'SCAB222620D17', 'SCAB230741179', 'SCAB22262300A', 'SCAB221452F3C')
  and tb02055_operacao like 'E' and tb02055_nomefor like '%LEXMARK%'  order by tb02002_data desc*/