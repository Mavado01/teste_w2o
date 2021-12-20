<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<?PHP require_once "DB/conexao.php";

$ID = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$nome = filter_input(INPUT_POST, 'razao_social', FILTER_SANITIZE_STRING);
$cnpj = filter_input(INPUT_POST, 'CNPJ', FILTER_SANITIZE_STRING);
$telefone = filter_input(INPUT_POST, 'Telefone', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$cep = filter_input(INPUT_POST, 'Cep', FILTER_SANITIZE_NUMBER_INT);
$bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
$cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
$estado = filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_STRING);
$rua = filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_STRING);
$numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_NUMBER_INT);
$complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING);

$alterar = "UPDATE empresas SET razao_social= '$nome', cnpj='$cnpj', telefone='$telefone', email='$email', cep='$cep', 
bairro='$bairro', cidade='$cidade', estado='$estado', rua='$rua', numero='$numero', complemento='$complemento' WHERE id='$ID'";

$conexao = novaConexao();
$updateEmpresa = $conexao->query($alterar);

if($conexao->error) {
    echo "Erro: " . $conexao->error;
}
var_dump($ID);
$conexao->close();
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

<section id="content">
    <div class="page dashboard-page">
        <div class="boxs-body">
            <div class="col-md-10">
                <h4>Confirmar alteração?</h4>
            </div>
            <div class= ""id="formulario">
            <form class="row g-3 container" name="cadastro" method="post">
                    <input type="hidden" name="id" id="id" value="<?=$ID?>">
                <div class="col-md-6 campo">
                    <label for="razao_social" class="form-label ">Razão Social*</label>
                    <input type="text" hover="Razão Social"  value= "<?=$nome?>" class="form-control" id="razao_social" name="razao_social" required>
                </div>
                <div  class="col-md-6 campo mt-4">
                    <label id="cnpj">CNPJ</label>
                    <input type="text" class="cnpj form-control" value="<?=$cnpj?>" maxlength="18" name="CNPJ" id="CNPJ" required>
                </div>
                <div class="col-md-6 campo">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name= "email" value= "<?= $email?>">
                </div>
                <div class="campo col-md-5 mt-4">
                    <label id="tel">Telefone</label>
                    <input type="text" class="telefone form-control" value= "<?=$telefone?>"  pattern=".{13,14}" maxlength="14" 
                    name="Telefone" id="Telefone" required>
                </div>
                <div class="campo col-md-2">
                    <label>Cep</label>
                    <input name="Cep" value= "<?=$cep?>"  class="form-control" type="text" id="cep" maxlength="9"/>
                </div>
                <div class="campo col-md-4 ">
                    <label>Cidade</label>
                    <input name="cidade" class="form-control" value= "<?=$cidade?>"  type="text" id="cidade"/>
                </div>
                <div class="campo col-md-2">  
                    <label>Estado</label>
                    <input name="uf" class="form-control" value= "<?=$estado?>"  type="text" id="uf"/>
                </div>
                <div class="campo col-md-4 ">
                    <label>Bairro</label>
                    <input name="bairro" class="form-control" value= "<?=$bairro?>"  type="text" id="bairro"/>
                </div>
                <div class="col-md-5 campo mt-4">
                    <label>Rua</label>
                    <input name="rua" class="form-control" value= "<?=$rua?>"  type="text" id="rua"/>
                </div>
                <div class="col-md-2 campo">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" class="form-control" name= "numero" value= "<?=$numero?>"  id="numero" value= "<?= $dados['numero'] ?>" >
                </div>
                <div class="col-md-5 campo">
                    <label for="complemento" class="form-label">Complemento</label>
                    <input type="text" class="form-control" id="complemento" name="complemento"  value= "<?= $complemento?>">
                </div>
                <div class="row align-items-center mt-5">
                    <div class="col-md-5"></div>
                    <a class="col-md-2 btn btn-danger" type="submit" value="Cadastrar" href="empresas.php"> Confirmar </a>
                </div>
                <?php
                


                ?>
            </form>
            </div>
        </div>    
    </div>    
</section>

<script src="assets\js\main.js"></script>

</body>
</html>