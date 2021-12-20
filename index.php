<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pessoas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets\css\style.css">
</head>
<body>
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
          <a class="nav-link " href="pessoas.php">Pessoas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="relatorios.php">Relatórios</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
 <div class="container ">
   <div class="body">
     <br><br><h3>Cadastro de empresas e pessoas</h3>
      <br>
      <br>
    <p>Inicialmente deve ser instaldo e configurado o servidor MySQL, para criar o banco de dados, basta clicar no link a baixo.</p>
     <a href="DB\db_empresas.php"> Configurar banco de dados</a>
     <br><br>
     <p>Após o banco de dados configurado, basta clicar no link a baixo para configurar as tabelas.</p>
     <a href="DB\criar_tabela.php"> Configurar tabelas</a>
     <br><br>
      <p>O sistema esta pronto para ser utilizado, você pode cadastrar novas empresas na aba, Empresas, bem como pode cadastrar novas pessoas na aba Apessoas.</p>
      <br><br> <br><br>
      <h4>Funões:</h4>
      <h5>Empresa:</h5>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
        <label class="form-check-label" for="flexCheckDefault">
          Cadastro de empresa
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
        <label class="form-check-label" for="flexCheckDefault">
          Validar CNPJ
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" >
        <label class="form-check-label" for="flexCheckDefault">
          Link para WhatsApp
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
        <label class="form-check-label" for="flexCheckDefault">
          Completar endereço com CEP
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
          Ordenar colunas na busca
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
          Permitir apenas e-mails válidos
        </label>
      </div>
      <h5>Colaboradores:</h5>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
        <label class="form-check-label" for="flexCheckDefault">
          Cadastro de Colaboradores
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" >
        <label class="form-check-label" for="flexCheckDefault">
          Validar nome completo
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" >
        <label class="form-check-label" for="flexCheckDefault">
          Apresentar idade
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
          Permitir apenas e-mails válidos
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" >
        <label class="form-check-label" for="flexCheckChecked">
        Link para WhatsApp
        </label>
      </div>
      <h5>Exportações</h5>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
          Exportar banco de dados para arquivo CSV ou JSON
        </label>
      </div>

   </div>
 </div>   
</body>
</html>