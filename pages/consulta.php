<?php
require '../db/conexao.php';
$resultado = $conexao->query("select * from produto order by id_produto desc");

?>

<main style="display: flex; flex-direction: column; align-items: center; width: 100%;">

<h2>Produtos cadastrados - TODOS</h2>

<div style="display: flex; justify-content: space-between; border-bottom: 1px solid #aaa; width: 70%">
        <div style="flex: 0.25; text-align: left;">Id</div>
        <div style="flex: 2; text-align: left;">Produto</div>
        <div style="flex: 1; text-align: right;">Preço unitário</div>
        <div style="flex: 1; text-align: right;">Quantidade</div>
</div>

<?php while($produto = $resultado->fetch_assoc()): ?>
    <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #aaa; width: 70%">
        <div style="flex: 0.25; text-align: left;"><?= $produto['id_produto'] ?></div>
        <div style="flex: 2; text-align: left;"><?= htmlspecialchars($produto['nome']) ?></div>
        <div style="flex: 1; text-align: right;"><?= number_format($produto['preco'], 2, ',', '.') ?></div>
        <div style="flex: 1; text-align: right;"><?= $produto['quantidade'] ?></div>
    </div>
<?php endwhile; ?>


</main>

