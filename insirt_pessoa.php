<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pessoas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
    require_once "DB/conexao.php";

    $nome1 = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email1 = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefone1 = filter_input(INPUT_POST, 'Telefone', FILTER_SANITIZE_STRING);
    $nascimento1 = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
    $id_empresa1 = filter_input(INPUT_POST, 'selectoption', FILTER_SANITIZE_NUMBER_INT);
    
    // LISTAR EMPRESAS PARA SELECIONAR

    $id_empresa = (int)$id_empresa1;
    $nome = $nome1 ? $nome1 : "vazio";
    $email = $email1? $email1 : "vazio";
    $telefone =  $telefone1;
    $nascimento =  $nascimento1 ? $nascimento1 : "0";
    $empresa =  $empresa1 ? $empresa1 : "vazio";
    
    $novaPessoa = "INSERT INTO pessoas SET nome= '$nome', email='$email', telefone='$telefone',  nascimento='$nascimento', 
    empresa='$empresa', id_empresa='$id_empresa', ativo='1' ";

    $conexao = novaConexao();
    $insertNovaPessoa = $conexao->query($novaPessoa);

    if($conexao->error) {
        echo "Erro: " . $conexao->error;
    }

    $conexao->close();
        


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
          <form class="row g-3 container" style="padding: 40px" name="cadastro" method="post">
              <div class="col-md-6 campo">
                  <label for="inputEmail4" class="form-label">Nome completo*</label>
                  <input type="text" hover="Razão Social" class="form-control" id="nome" name="nome" value="<?= $nome ?>" required>
              </div>
              <div class="col-md-6 campo">
                  <label for="inputEmail4" class="form-label">Email*</label>
                  <input type="email" class="form-control" id="email" name="email" value="<?=$email ?>" required>
              </div>
              <div class="col-md-5 campo">
                  <label for="inputAddress2" class="form-label">Telefone*</label>
                  <input type="text" name="telefone "class="form-control telefone" pattern=".{13,14}" maxlength="14" 
                  id="telefone" value="<?= $telefone ?>"  required >
              </div>
              <div class="col-md-1 campo">
                  <a href="https\\:www.doceroma.com.br">WhatsApp</a>
              </div>    
              <div class="col-md-6 campo">
                  <label for="inputCity" class="form-label">Data de nascimento</label>
                  <input type="text" class="form-control" id="data" name="data" value="<?= $nascimento?>" >
              </div>
              
              <a type="submit" href="pessoas.php" class="btn btn-secondary" >Confirmar</a>
          </form>
      </div>
  </section>

   
</body>
</html>