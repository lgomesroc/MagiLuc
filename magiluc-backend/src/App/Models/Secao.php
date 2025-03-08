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

    /**
     * Retorna a conexão com o banco de dados.
     *
     * @return PDO
     */
    public function getConnection()
    {
        return $this->conexao;
    }

    /**
     * Inicializa as seções no banco de dados.
     */
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

    /**
     * Lista todas as seções.
     *
     * @return array
     */
    public function listarSecoes()
    {
        $query = "SELECT * FROM secoes";
        $stmt = $this->conexao->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Atualiza o tipo de bebida permitido em uma seção.
     *
     * @param int $secaoId ID da seção
     * @param string|null $tipo Tipo de bebida permitido (alcoolica, nao_alcoolica, null)
     * @return array Mensagem de sucesso
     * @throws InvalidArgumentException Se o tipo for inválido
     */
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

    /**
     * Verifica o tipo de bebida permitido em uma seção.
     *
     * @param int $secaoId ID da seção
     * @return string|null Tipo de bebida permitido
     */
    public function verificarTipoPermitido($secaoId)
    {
        $query = "SELECT tipo_permitido FROM secoes WHERE id = :secao_id";
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':secao_id', $secaoId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['tipo_permitido'];
    }

    /**
     * Valida se uma bebida pode ser adicionada a uma seção.
     *
     * @param int $secaoId ID da seção
     * @param string $tipo Tipo de bebida (alcoolica, nao_alcoolica)
     * @return bool True se a bebida pode ser adicionada, False caso contrário
     */
    public function validarEntradaBebida($secaoId, $tipo)
    {
        $tipoPermitido = $this->verificarTipoPermitido($secaoId);

        
        if ($tipoPermitido === null) {
            $this->atualizarTipoPermitido($secaoId, $tipo);
            return true;
        }

        
        return $tipoPermitido === $tipo;
    }

    /**
     * Retorna todas as seções.
     *
     * @return array
     */
    public function getAll()
    {
        $query = "SELECT * FROM secoes";
        $stmt = $this->conexao->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}