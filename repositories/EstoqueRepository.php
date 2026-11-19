<?php 

require_once __DIR__. '/../config/Database.php';
require_once __DIR__. '/../models/Estoque.php';
require_once __DIR__. '/../interfaces/RepositoryInterface.php';

class EstoqueRepository implements RepositoryInterface{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::conectar();
    }

    public function criar($objeto) {
        $sql = "INSERT INTO estoque (produto, quantidade, preco) VALUES (:p, :q, :v)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':p' => $objeto->getProduto(),
            ':q' => $objeto->getQuantidade(),
            ':v' => $objeto->getPreco()
        ]);
    }

    #[Override]
    public function listar()
    {
        $stmt = $this->conn->query("SELECT * FROM estoque ORDER BY id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    #[Override]
    public function buscarPorId($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM estoque WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    #[Override]
    public function atualizar($id, $objeto)
    {
        $sql = "UPDATE estoque SET produto=:p, quantidade=:q, preco=:v WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':p' => $objeto->getProduto(),
            ':q' => $objeto->getQuantidade(),
            ':v' => $objeto->getPreco(),
            ':id' => $id
        ]);
    }

    #[Override]
    public function excluir($id)
    {
        $sql = "DELETE FROM estoque WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}
?>
