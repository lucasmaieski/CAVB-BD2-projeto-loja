<?php
require '../db/conexao.php';

// 1. Pega o valor digitado no formulário (se não digitou nada, fica vazio)
$qtd_min = isset($_GET['qtd_min']) ? $_GET['qtd_min'] : '';

// 2. Cria a consulta SQL padrão
$sql = "SELECT * FROM produto";

// 3. SE o usuário digitou uma quantidade, adicionamos o WHERE
if ($qtd_min !== '') {
    $sql .= " WHERE quantidade >= ?";
}

// 4. O ORDER BY fica SEMPRE no final de tudo
$sql .= " ORDER BY id_produto DESC";


// 5. Prepara a consulta no banco de dados (Segurança contra invasões)
$stmt = $conexao->prepare($sql);

// 6. SE o filtro foi usado, precisamos encaixar o número digitado no lugar do "?"
if ($qtd_min !== '') {
    $stmt->bind_param("i", $qtd_min); // "i" significa que o valor é um número Inteiro
}    

// 7. Executa a busca e guarda o resultado
$stmt->execute();
$resultado = $stmt->get_result();
?>

<main style="display: flex; flex-direction: column; align-items: center; width: 100%;">

<h2>Produtos cadastrados - TODOS</h2>


 <!-- FORMULÁRIO APENAS COM QUANTIDADE MÍNIMA -->
 <form method="GET" action="" style="display: flex; gap: 15px; margin-bottom: 25px; background: #f4f4f4; padding: 15px; border-radius: 5px; width: 70%;">
        <div style="display: flex; flex-direction: column;">
            <label for="qtd_min" style="margin-bottom: 5px; font-size: 14px;">Quantidade Mínima no Estoque:</label>
            <!-- O value="" mantém o número que você digitou na caixinha depois de clicar em filtrar -->
            <input type="number" name="qtd_min" id="qtd_min" value="<?= htmlspecialchars($qtd_min) ?>" style="padding: 6px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="display: flex; align-items: flex-end;">
            <button type="submit" style="padding: 8px 15px; background: #007BFF; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">Filtrar</button>
            
            <!-- Se tiver um filtro ativo, mostra o botão para limpar -->
            <?php if ($qtd_min !== ''): ?>
                <a href="?" style="margin-left: 10px; padding: 8px 15px; background: #6c757d; color: white; text-decoration: none; border-radius: 4px; font-size: 14px; font-weight: bold;">Mostrar Todos</a>
            <?php endif; ?>
        </div>
    </form>



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

