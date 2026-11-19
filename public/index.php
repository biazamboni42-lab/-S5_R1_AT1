<?php 
require_once __DIR__ . '/../repositories/EstoqueRepository.php';

$estoques = [];
$erro = $_GET['erro'] ?? null;

try {
    $repo = new EstoqueRepository();
    $estoques = $repo->listar();
} catch (Throwable $e) {
    $erro = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Estoque</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            margin: 40px;
        }

        nav a{
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
        }

        table{
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td{
            border: 1px solid #eee;
            padding: 8px;
        }
        th{
            background: #eee;
        }
    </style>
</head>
<body>
    <h1>Sistema de Cadastro de Estoque</h1>
    <?php if ($erro): ?>
        <p style="color: #b00020;"><strong>Erro:</strong> <?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>
    <nav>
        <a href="index.php">Listar Estoque</a>
        <a href="criar.php">Novo Produto</a>
    </nav>
    <table>
        <tr>
            <th>ID</th>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>
        <?php foreach($estoques as $e): ?>
            <tr>
                <td><?= $e['id'] ?></td>
                <td><?= $e['produto'] ?></td>
                <td><?= $e['quantidade'] ?></td>
                <td><?= $e['preco'] ?></td>
                <td>
                    <a href="editar.php?id=<?= $e['id'] ?>">Editar</a> |
                    <a href="excluir.php?id=<?= $e['id'] ?>" onclick="return confirm('Deseja Excluir?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
