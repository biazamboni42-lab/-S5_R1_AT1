<?php 
require_once __DIR__. '/../repositories/EstoqueRepository.php';

$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $estoque = new Estoque(
            $_POST['produto'],
            $_POST['quantidade'],
            $_POST['preco']
        );
        (new EstoqueRepository())->criar($estoque);
        header("Location: index.php");
        exit;
    } catch (Throwable $e) {
        $erro = $e->getMessage();
    }
}
?>

<?php if ($erro): ?>
    <p style="color: #b00020;"><strong>Erro:</strong> <?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>
<form action="" method="post">
    <input type="text" name="produto" id="produto" placeholder="Produto" required><br>
    <input type="number" name="quantidade" id="quantidade" placeholder="Quantidade" required><br>
    <input type="number" step="0.01" name="preco" id="preco" placeholder="Preço" required><br>
    <button type="submit">Cadastrar</button>
</form>
