<?php 
require_once __DIR__ . '/../repositories/EstoqueRepository.php';

try {
    if (!isset($_GET['id'])) {
        throw new InvalidArgumentException("ID do produto não informado.");
    }

    (new EstoqueRepository())->excluir($_GET['id']);
    header("Location: index.php");
} catch (Throwable $e) {
    header("Location: index.php?erro=" . urlencode($e->getMessage()));
}
exit;
?>
