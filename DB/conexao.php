<?php
function novaConexao($banco = 'teste_w2o') {
    $servidor = 'localhost';
    $usuario = 'root';
    $senha = 'root';

    $conexao = new mysqli($servidor, $usuario, $senha, $banco);

    if($conexao->connect_error) {
        echo "Desconectado! Erro: " . $conexao->connect_error;
    }

    return $conexao;
}

?>
