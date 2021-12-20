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

    
    function calc_idade($dataNascimento) {
    $dataNascimento=explode('/',$dataNascimento);
    $data=date('d/m/Y'); $data=explode('/',$data); 
    $anos=$data[2]-$dataNascimento[2]; 
    if($dataNascimento[1] > $data[1]) return $anos-1; 
    if($dataNascimento[1] == $data[1]){ 
      if($dataNascimento[0] <= $data[0]) { return $anos; } else{ return $anos-1; } }

    return $anos; }

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
    $sql = "SELECT * FROM pessoas WhERE ativo = '1'";
    
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
<section id="content">
  <div class="page dashboard-page">
      <div class="container">
      <div class="modal-body" id="formulario">
          <form class="row g-3 container" style="padding: 40px" name="cadastro" method="post" action="<?=$acao = $up ? "update_pessoa.php" : "insirt_pessoa.php"?>">
              <div class="col-md-6 campo">
                  <input type="hidden" name="id" value="<?= $dados['0'] ?>">
                  <label for="inputEmail4" class="form-label">Nome completo*</label>
                  <input type="text" hover="Razão Social" class="form-control" id="nome" name="nome" value="<?= $dados['1'] ?>" required>
              </div>
              <div class="col-md-6 campo">
                  <label for="inputEmail4" class="form-label">Email*</label>
                  <input type="email" class="form-control" id="email" name="email" value="<?= $dados['2'] ?>" required>
              </div>
              <div class="col-md-3 campo">
                  <label for="telefone" class="form-label">Telefone*</label>
                  <input type="text" class="telefone form-control" value="<?= $dados['3'] ?>" pattern=".{13,14}" maxlength="14"
                   name="Telefone" id="Telefone" required>
              </div>
              <div class="col-md-1 campo">
                  <a href="https\\:www.doceroma.com.br">WhatsApp</a>
              </div>    
              <div class="col-md-3 campo">
                  <label for="inputCity" class="form-label">Data de nascimento</label>
                  <input type="text" class="form-control" id="data" name="data" value="<?= $dados['4']?>" >
              </div>
              <div class="col-md-1 campo">
                  <label for="inputCity" class="form-label text-center">Idade</label>
                  <input type="text" class="form-control text-center" id="inputCity" readonly value="##">
              </div>
              <div class="col-md-4 campo">
                <label for="inputCity" class="form-label text-center">Empresa</label>
                <select class="form-select" aria-label="Default select example " name="selectoption" id="selectoption">
                  <!-- verificar para arrumar para o update -->
                    <option selected>Escolha uma empresa</option> 
                  <?php foreach($empresas as $empresa): ?>  
                    <option value="<?= $empresa['id']?>" ><?= $empresa['razao_social']?></option>
                  <?php endforeach; ?>
                  </select>
              </div>
              <button type="submit" class="btn btn-secondary" >Salvar</button>
          </form>
      </div>
  </section>
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