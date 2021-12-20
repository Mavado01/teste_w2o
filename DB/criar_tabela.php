<div class="titulo">Criar Tabela</div>

<?php

require_once "conexao.php";

// CRIANDO TABELA DA EMPRESA
$sql = "CREATE TABLE IF NOT EXISTS empresas (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    razao_social VARCHAR(100) NOT NULL,
    cnpj VARCHAR(100) NOT NULL,
    telefone VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    cep VARCHAR(100) NOT NULL,
    bairro VARCHAR(100),
    cidade VARCHAR(100),
    estado VARCHAR(100),
    rua VARCHAR(100),
    numero INT,
    complemento VARCHAR(100),
    ativo BOOLEAN
)";

$conexao = novaConexao();
$resultado = $conexao->query($sql);

if($resultado) {
    echo "Sucesso :)";
} else {
    echo "Erro: " . $conexao->error;
}

$conexao->close();

// CRIANDO TABELA DE PESSOAS

// nascimento DATE,
// email VARCHAR(100) NOT NULL,

// tabela de testes

// DDL - Data Definition Lang.
$sql1 = "CREATE TABLE IF NOT EXISTS pessoas (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(100) NOT NULL,
    nascimento VARCHAR(100),
    EMPRESA VARCHAR(100),
    id_empresa INT(6),
    ATIVO BOOLEAN
)";

$conexao = novaConexao();
$resultado = $conexao->query($sql1);

if($resultado) {
    echo "<br/> Sucesso :)";
} else {
    echo "Erro: " . $conexao->error;
}

$conexao->close();