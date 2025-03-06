<?php
namespace Models;

use App\Config\Database;
use PDO;

class Secao {
    private $conexao;

    public function __construct() {
        $this->conexao = Database::getInstance()->getConnection();
    }

    public function inicializarSecoes() {
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

    public function listarSecoes() {
        $query = "SELECT * FROM secoes";
        $stmt = $this->conexao->query($query);
        return $stmt->fetchAll();
    }

    public function atualizarTipoPermitido($secaoId, $tipo) {
        $query = "UPDATE secoes SET tipo_permitido = :tipo WHERE id = :secao_id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tipo', $tipo);
        $stmt->bindValue(':secao_id', $secaoId);
        $stmt->execute();

        return [
            'mensagem' => 'Tipo permitido atualizado com sucesso'
        ];
    }

    public function verificarTipoPermitido($secaoId) {
        $query = "SELECT tipo_permitido FROM secoes WHERE id = :secao_id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':secao_id', $secaoId);
        $stmt->execute();

        return $stmt->fetch()['tipo_permitido'];
    }

    public function validarEntradaBebida($secaoId, $tipo) {
        $tipoPermitido = $this->verificarTipoPermitido($secaoId);

        // Se não há tipo definido, pode adicionar
        if ($tipoPermitido === null) {
            $this->atualizarTipoPermitido($secaoId, $tipo);
            return true;
        }

        // Se o tipo for diferente do permitido, não pode adicionar
        return $tipoPermitido === $tipo;
    }

    public function getConnection() {
        return $this->conexao;
    }
}