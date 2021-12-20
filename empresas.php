<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    

</head>
<body>
    <?PHP require_once "DB/conexao.php";

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
    <a class="navbar-brand" href="index.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav justify-content-end">
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="empresas.php">Empresas</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="pessoas.php">Pessoas</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="relatorios.php">Relatórios</a>
    </li>
</ul>
</div>
</div>
</nav>
<?php
    $conexao = novaConexao();
    // EXCLUIR REGISTRO 
    $cod = filter_input(INPUT_GET, 'excluir', FILTER_SANITIZE_NUMBER_INT);
    $alt = "UPDATE empresas SET ativo= '0' WHERE id= '$cod'";
    $resultado = $conexao->query($alt);
    
    // END EXCLUIR REGISTRO
    // UPDATE
    $up = filter_input(INPUT_GET, 'edit', FILTER_SANITIZE_NUMBER_INT);
    $buscar="SELECT * FROM empresas WHERE id= '$up'";
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
    
  
// LISTAR EMPRESAS ATIVAS
    $sql = "SELECT id, razao_social, cnpj, telefone FROM empresas WhERE ativo = '1'";

    $resultado = $conexao->query($sql);

    $registros = [];

    if($resultado->num_rows > 0) {
        while($row = $resultado->fetch_assoc()) {
            $registros[] = $row;
        }
    } elseif($conexao->error) {
        echo "Erro: " . $conexao->error;
    }

    $conexao->close();
         
    ?>
<section id="content">
    <div class="page dashboard-page">
        <div class="container boxs-body">
            <div class="col-md-10">
                <h4>Cadastro de Empresas</h4>
            </div>
            <div class= ""id="formulario">
            <form class="row g-3 container" name="cadastro" method="post" action="<?=$acao = $up ? "update.php" : "insert.php"?>">
                    <input type="hidden"  id="id" name="id" value= "<?=$dados['0']?>"> 
                <div class="col-md-6 campo">
                    <label for="razao_social" class="form-label ">Razão Social*</label>
                    <input type="text" hover="Razão Social"  value= "<?=$dados['1']?>" class="form-control" id="razao_social" name="razao_social" required>
                </div>
                <div  class="col-md-6 campo mt-4">
                    <label id="cnpj">CNPJ*</label>
                    <input type="text" class="cnpj form-control" value="<?=$dados['2']?>" maxlength="18" name="CNPJ" required>
                </div>
                <div class="col-md-6 campo">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name= "email" value= "<?= $dados['4'] ?>">
                </div>
                <div class="campo col-md-5 mt-4">
                    <label id="tel">Telefone*</label>
                    <input type="text" class="telefone form-control" value= "<?=$dados['3']?>"  pattern=".{13,14}" maxlength="14" name="Telefone" required>
                </div>
                <div class="col-md-1 campo">
                    <a href="https\\:www.doceroma.com.br">WhatsApp</a>
                </div>  
                <div class="campo col-md-2">
                    <label>Cep</label>
                    <input name="Cep" value= "<?=$dados['5']?>"  class="form-control" type="text" id="cep" maxlength="9"/>
                </div>
                <div class="campo col-md-4 ">
                    <label>Cidade</label>
                    <input name="cidade" class="form-control" value= "<?=$dados['7']?>"  type="text" id="cidade"/>
                </div>
                <div class="campo col-md-2">  
                    <label>Estado</label>
                    <input name="uf" class="form-control" value= "<?=$dados['8']?>"  type="text" id="uf"/>
                </div>
                <div class="campo col-md-4 ">
                    <label>Bairro</label>
                    <input name="bairro" class="form-control" value= "<?=$dados['6']?>"  type="text" id="bairro"/>
                </div>
                <div class="col-md-5 campo mt-4">
                    <label>Rua</label>
                    <input name="rua" class="form-control" value= "<?=$dados['9']?>"  type="text" id="rua"/>
                </div>
                <div class="col-md-2 campo">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" class="form-control" name= "numero" value= "<?=$dados['10']?>"  id="numero" value= "<?= $dados['numero'] ?>" >
                </div>
                <div class="col-md-5 campo">
                    <label for="complemento" class="form-label">Complemento</label>
                    <input type="text" class="form-control" id="complemento" name="complemento"  value= "<?= $dados['11'] ?>">
                </div>
                <div class="row align-items-center mt-5">
                    <div class="col-md-5" ></div>
                   
                   <button type="submit" class="btn btn-info"> Salvar </button>
                    
                </div>
            </form>
            </div>
        </div>    
    </div>    
</section>

    <div class="table-responsive container mt-8">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th>Razão social</th>
                    <th>CNPJ</th>
                    <th >Telefone</th>
                    <th class="text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($registros as $registro): ?>
                    <tr>
                        <td class="text-center"><?= $registro['id'] ?></td>
                        <td><?= $registro['razao_social'] ?></td>
                        <td><?= $registro['cnpj'] ?></td>
                        <td ><?= $registro['telefone'] ?></td>
                        <td class="td-actions text-right">
                            <a type="button" rel="tooltip" href="http://localhost/pessoas_empresa.php?&empresa=<?= $registro['id'] ?>"title="Funcionários" class="btn btn-outline-info btn-simple btn-xs" data-toggle="modal" data-target="#modalpessoasempresa">
                                <i class="fa fa-user"></i>
                             </a>
                            <a type="button" rel="tooltip" href="http://localhost/empresas.php?&edit=<?= $registro['id'] ?>" title="Editar" class="btn btn-outline-success btn-simple btn-xs" data-toggle="modal" data-target="#modaleditempresa">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a type="button" rel="tooltip" href="http://localhost/empresas.php?&excluir=<?= $registro['id'] ?>" title="Remove" class="btn btn-outline-danger btn-simple btn-xs">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>      
    </div>        
<script src="assets\js\main.js"></script>
</body>
</html>