<?php 
require_once __DIR__ . '/../repositories/EstoqueRepository.php';

$erro = null;
$estoque = null;

try {
    $repo = new EstoqueRepository();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $estoque = new Estoque(
            $_POST['produto'],
            $_POST['quantidade'],
            $_POST['preco']
        );
        $repo->atualizar($_POST['id'], $estoque);
        header("Location: index.php");
        exit;
    }

    if (isset($_GET['id'])) {
        $estoque = $repo->buscarPorId($_GET['id']);
    }
} catch (Throwable $e) {
    $erro = $e->getMessage();
}
?>

<?php if ($erro): ?>
    <p style="color: #b00020;"><strong>Erro:</strong> <?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>

<?php if ($estoque): ?>
<form action="" method="post">
    <input type="hidden" name="id" value="<?= $estoque['id'] ?>">
    <input type="text" name="produto" value="<?= $estoque['produto'] ?>"><br>
    <input type="number" name="quantidade" value="<?= $estoque['quantidade'] ?>"><br>
    <input type="number" step="0.01" name="preco" value="<?= $estoque['preco'] ?>"><br>
    <button type="submit">Atualizar</button>
</form>
<?php endif; ?>

