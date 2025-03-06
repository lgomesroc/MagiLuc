<?php
namespace Models;

use App\Config\Database;
use PDO;

class Estoque {
    private $conexao;

    public function __construct() {
        $this->conexao = Database::getInstance()->getConnection();
    }

    public function calcularVolumePorTipo() {
        $query = "SELECT tipo, SUM(volume) as volume_total FROM estoque GROUP BY tipo";
        $stmt = $this->conexao->query($query);
        return $stmt->fetchAll();
    }

    public function buscarSecoesDisponiveisPorTipo($tipo, $volume) {
        $capacidadeMaxima = $tipo === 'alcoolica' ? 500 : 400;

        $query = "
            SELECT 
                s.id as secao_id, 
                s.nome as secao_nome, 
                (s.capacidade_maxima - COALESCE(SUM(e.volume), 0)) as espaco_disponivel
            FROM 
                secoes s
            LEFT JOIN 
                estoque e ON s.id = e.secao_id AND e.tipo = :tipo
            WHERE 
                (s.capacidade_maxima - COALESCE(SUM(e.volume), 0)) >= :volume
            GROUP BY 
                s.id, s.nome
            HAVING 
                espaco_disponivel >= :volume
        ";

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tipo', $tipo);
        $stmt->bindValue(':volume', $volume);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function adicionarVolume($secaoId, $tipo, $volume) {
        $query = "
            INSERT INTO estoque (secao_id, tipo, volume, data_registro) 
            VALUES (:secao_id, :tipo, :volume, NOW())
        ";

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':secao_id', $secaoId);
        $stmt->bindValue(':tipo', $tipo);
        $stmt->bindValue(':volume', $volume);
        $stmt->execute();

        return [
            'id' => $this->conexao->lastInsertId(),
            'mensagem' => 'Volume adicionado com sucesso'
        ];
    }

    public function removerVolume($secaoId, $tipo, $volume) {
        $query = "
            UPDATE estoque 
            SET volume = volume - :volume 
            WHERE secao_id = :secao_id AND tipo = :tipo AND volume >= :volume
        ";

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':secao_id', $secaoId);
        $stmt->bindValue(':tipo', $tipo);
        $stmt->bindValue(':volume', $volume);
        $stmt->execute();

        return [
            'linhas_afetadas' => $stmt->rowCount(),
            'mensagem' => 'Volume removido com sucesso'
        ];
    }

    public function verificarVolumeDisponivel($secaoId, $tipo) {
        $query = "
            SELECT COALESCE(SUM(volume), 0) as volume_total 
            FROM estoque 
            WHERE secao_id = :secao_id AND tipo = :tipo
        ";

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':secao_id', $secaoId);
        $stmt->bindValue(':tipo', $tipo);
        $stmt->execute();

        return $stmt->fetch()['volume_total'];
    }

    public function buscarUltimaEntradaDia($tipo) {
        $query = "
            SELECT * FROM estoque 
            WHERE tipo = :tipo 
            AND DATE(data_registro) = CURRENT_DATE 
            LIMIT 1
        ";

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tipo', $tipo);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function verificarVolumeEstoqueSecao($secaoId) {
        $query = "
            SELECT COALESCE(SUM(volume), 0) as volume_total 
            FROM estoque 
            WHERE secao_id = :secao_id
        ";
    
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':secao_id', $secaoId);
        $stmt->execute();
    
        return $stmt->fetch()['volume_total'];
    }

    public function getAll() {
        $query = "SELECT * FROM estoque";
        $stmt = $this->conexao->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}