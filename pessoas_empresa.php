<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pessoas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
    require_once "DB/conexao.php";

    $emp = filter_input(INPUT_GET, 'empresa', FILTER_SANITIZE_NUMBER_INT);
    
    $conexao = novaConexao();
    // EXCLUIR REGISTRO 
    $cod = filter_input(INPUT_GET, 'excluir', FILTER_SANITIZE_NUMBER_INT);
    $alt = "UPDATE pessoas SET ativo= '0' WHERE id= '$cod'";
    $resultado = $conexao->query($alt);
    
    // END EXCLUIR REGISTRO
    // UPDATE
    $up = filter_input(INPUT_GET, 'edit', FILTER_SANITIZE_NUMBER_INT);
    $buscar="SELECT * FROM pessoas WHERE id= '$up'";
    $resultadoUpdate = $conexao->query($buscar);
    $campos = [];
    
    if(!!$resultadoUpdate) {
        
        while($row = $resultadoUpdate->fetch_assoc()) {
            $campos[] = $row;
        }
    } elseif($conexao->error) {
        echo "Erro: " . $conexao->error;
    }
    foreach ($campos['0'] as $dado) {
       $dados[] = $dado;
    }
   
    // LISTAR PESSOAS ATIVAS
    $sql = "SELECT * FROM pessoas WhERE id_empresa = '$emp'";
    
    $resultado = $conexao->query($sql);
    
    $registros = [];
    
    if($resultado->num_rows > 0) {
      while($row = $resultado->fetch_assoc()) {
        $registros[] = $row;
      }
    } elseif($conexao->error) {
      echo "Erro: " . $conexao->error;
    }

    // LISTAR EMPRESAS PARA SELECIONAR
    $sqlEmpresa = "SELECT * FROM empresas WhERE ativo = '1'";
    
    $resultadoEmpresas = $conexao->query($sqlEmpresa);
    
    $empresas = [];
    
    if($resultadoEmpresas->num_rows > 0) {
      while($row = $resultadoEmpresas->fetch_assoc()) {
        $empresas[] = $row;
      }
    } elseif($conexao->error) {
      echo "Erro: " . $conexao->error;
    }
    
    
    $conexao->close();
    
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="empresas.php">Empresas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active " href="pessoas.php">Pessoas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="relatorios.php">Relatórios</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<h3>Pessoas cadastradas na empresa</h3>
<div class="table-responsive container mt-8">
        <table class="table table-hover">
            <thead>
                <tr>
                  <th>Nome Completo</th>
                  <th>E-mail</th>
                  <th>Telefone</th>
                  <th class="text-right">Nascimento</th>
                  <th class="text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($registros as $registro): ?>
                    <tr>
                      <td><?=$registro['nome']?></td>
                      <td><?=$registro['email']?></td>
                      <td><?=$registro['telefone']?></td>
                      <td class="text-right"><?=$registro['nascimento']?></td>
                      <td>
                          <a type="button" rel="tooltip" href="http://localhost/pessoas.php?&edit=<?= $registro['id'] ?>" title="Editar" class="btn btn-outline-success btn-simple btn-xs" data-toggle="modal" data-target="#modaleditempresa">
                              <i class="fa fa-edit"></i>
                          </a>
                          <a type="button" rel="tooltip" href="http://localhost/pessoas.php?&excluir=<?= $registro['id'] ?>" title="Remove" class="btn btn-outline-danger btn-simple btn-xs">
                              <i class="fa fa-times"></i>
                          </a>
                      </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>      
    </div>        
   
</body>
</html>