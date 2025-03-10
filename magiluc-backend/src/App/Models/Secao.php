<?php

namespace App\Models;

use App\Config\Database;
use PDO;
use InvalidArgumentException;

class Secao
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = Database::getInstance()->getConnection();
    }

    
    public function getConnection()
    {
        return $this->conexao;
    }

    
    public function inicializarSecoes()
    {
        $secoes = [
            ['nome' => 'Seção 1', 'tipo_permitido' => null, 'capacidade_alcoolica' => 500, 'capacidade_nao_alcoolica' => 400],
            ['nome' => 'Seção 2', 'tipo_permitido' => null, 'capacidade_alcoolica' => 500, 'capacidade_nao_alcoolica' => 400],
            ['nome' => 'Seção 3', 'tipo_permitido' => null, 'capacidade_alcoolica' => 500, 'capacidade_nao_alcoolica' => 400],
            ['nome' => 'Seção 4', 'tipo_permitido' => null, 'capacidade_alcoolica' => 500, 'capacidade_nao_alcoolica' => 400],
            ['nome' => 'Seção 5', 'tipo_permitido' => null, 'capacidade_alcoolica' => 500, 'capacidade_nao_alcoolica' => 400]
        ];

        $query = "
            INSERT INTO secoes (nome, tipo_permitido, capacidade_alcoolica, capacidade_nao_alcoolica) 
            VALUES (:nome, :tipo_permitido, :capacidade_alcoolica, :capacidade_nao_alcoolica)
            ON DUPLICATE KEY UPDATE 
            tipo_permitido = :tipo_permitido,
            capacidade_alcoolica = :capacidade_alcoolica,
            capacidade_nao_alcoolica = :capacidade_nao_alcoolica
        ";

        $stmt = $this->conexao->prepare($query);

        foreach ($secoes as $secao) {
            $stmt->bindValue(':nome', $secao['nome']);
            $stmt->bindValue(':tipo_permitido', $secao['tipo_permitido']);
            $stmt->bindValue(':capacidade_alcoolica', $secao['capacidade_alcoolica']);
            $stmt->bindValue(':capacidade_nao_alcoolica', $secao['capacidade_nao_alcoolica']);
            $stmt->execute();
        }
    }

    
    public function listarSecoes()
    {
        $query = "SELECT * FROM secoes";
        $stmt = $this->conexao->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function atualizarTipoPermitido($secaoId, $tipo)
    {
        if (!in_array($tipo, ['alcoolica', 'nao_alcoolica', null])) {
            throw new InvalidArgumentException("Tipo de bebida inválido");
        }

        $query = "UPDATE secoes SET tipo_permitido = :tipo WHERE id = :secao_id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tipo', $tipo);
        $stmt->bindValue(':secao_id', $secaoId);
        $stmt->execute();

        return [
            'mensagem' => 'Tipo permitido atualizado com sucesso'
        ];
    }

    
    public function verificarTipoPermitido($secaoId)
    {
        $query = "SELECT tipo_permitido FROM secoes WHERE id = :secao_id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':secao_id', $secaoId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['tipo_permitido'];
    }

    
    public function validarEntradaBebida($secaoId, $tipo)
    {
        $tipoPermitido = $this->verificarTipoPermitido($secaoId);

        
        if ($tipoPermitido === null) {
            $this->atualizarTipoPermitido($secaoId, $tipo);
            return true;
        }

        
        return $tipoPermitido === $tipo;
    }

   
    public function getAll()
    {
        $query = "SELECT * FROM secoes";
        $stmt = $this->conexao->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}