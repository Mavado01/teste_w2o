<div class="titulo">Criar Banco</div>

<?php

require_once "conexao.php";

$conexao = novaConexao(null);
$sql = 'CREATE DATABASE IF NOT EXISTS teste_w2o';

$resultado = $conexao->query($sql);

if($resultado) {
    echo "Sucesso :)";
} else {
    echo "Erro: " . $conexao->error;
}

$conexao->close();

echo "fim!";