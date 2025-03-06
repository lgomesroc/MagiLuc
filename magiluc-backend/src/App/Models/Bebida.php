<?php
namespace Models;

use App\Config\Database;

class Bebida
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM bebidas";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM bebidas WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO bebidas (tipo, nome, volume, secao) VALUES (:tipo, :nome, :volume, :secao)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':tipo', $data['tipo']);
        $stmt->bindParam(':nome', $data['nome']);
        $stmt->bindParam(':volume', $data['volume']);
        $stmt->bindParam(':secao', $data['secao']);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $query = "UPDATE bebidas SET tipo = :tipo, nome = :nome, volume = :volume, secao = :secao WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':tipo', $data['tipo']);
        $stmt->bindParam(':nome', $data['nome']);
        $stmt->bindParam(':volume', $data['volume']);
        $stmt->bindParam(':secao', $data['secao']);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM bebidas WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }
}