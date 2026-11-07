<?php
require '../db/conexao.php';

if($_POST) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $qnt = $_POST['quantidade'];

    $sql = "INSERT INTO produto (nome, descricao, preco, quantidade) VALUES ('$nome', '$descricao', '$preco', '$qnt')";

    $conexao->query($sql);
}
?>

<h2>CADASTRO DO PRODUTO</h2>

<form method="POST">

    <fieldset style="display: grid; grid-template-columns: max-content 1fr; gap: 5px;">
        <legend>Dados Principais</legend>

        <label for="nome">Nome produto: </label>
        <input id="nome" name="nome" type="text" required>

        <label for="descricao">Descrição: </label>
        <textarea id="descricao" name="descricao" rows="5" cols="40"></textarea>

        <label for="preco">Preço: </label>
        <input id="preco" name="preco" type="number" step="0.01" min="0.01" required>

        <label for="qnt">Quantidade: </label>
        <input id="qnt" name="quantidade" type="number" required>

        
    <button type="reset" id="btn-limpar">Limpar campos</button>
    <button type="submit" id="btn-enviar">Cadastrar</button>

    </fieldset>

</form>