<?php
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'a fazer';

$conexao = new mysqli($host, $usuario; $senha, $banco);

if ($conexao -> conect_error) {
    die('Erro de conexão' . $conexao -> connect_error);
}
?>