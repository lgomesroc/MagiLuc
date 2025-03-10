<?php

namespace App\Models;

use App\Config\Database;

class Historico
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM historico";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM historico WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "INSERT INTO historico (tipo, volume, secao, responsavel, data) VALUES (:tipo, :volume, :secao, :responsavel, :data)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':tipo', $data['tipo']);
        $stmt->bindParam(':volume', $data['volume']);
        $stmt->bindParam(':secao', $data['secao']);
        $stmt->bindParam(':responsavel', $data['responsavel']);
        $stmt->bindParam(':data', $data['data']);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function update($id, $data)
    {
        $query = "UPDATE historico SET tipo = :tipo, volume = :volume, secao = :secao, responsavel = :responsavel, data = :data WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':tipo', $data['tipo']);
        $stmt->bindParam(':volume', $data['volume']);
        $stmt->bindParam(':secao', $data['secao']);
        $stmt->bindParam(':responsavel', $data['responsavel']);
        $stmt->bindParam(':data', $data['data']);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM historico WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function registrarEntrada($dados) {
        
        return [
            'mensagem' => 'Entrada registrada no histórico com sucesso',
            'tipo' => $dados['tipo'],
            'volume' => $dados['volume'],
            'secao_id' => $dados['secao_id'],
            'responsavel' => $dados['responsavel'],
            'data' => date('Y-m-d H:i:s')
        ];
    }

    public function registrarSaida($dados) {
        
        return [
            'mensagem' => 'Saída registrada no histórico com sucesso',
            'tipo' => $dados['tipo'],
            'volume' => $dados['volume'],
            'secao_id' => $dados['secao_id'],
            'responsavel' => $dados['responsavel'],
            'data' => date('Y-m-d H:i:s')
        ];
    }
}