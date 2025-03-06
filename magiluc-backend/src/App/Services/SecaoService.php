<?php
namespace Services;

use Models\Secao;
use Models\Estoque;

class SecaoService {
    private $secaoModel;
    private $estoqueModel;

    public function __construct() {
        $this->secaoModel = new Secao();
        $this->estoqueModel = new Estoque();
    }

    public function listarSecoes() {
        return $this->secaoModel->listarSecoes();
    }

    public function obterSecaoPorId($id) {
        $query = "SELECT * FROM secoes WHERE id = :id";
        $stmt = $this->secaoModel->getConnection()->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        
        $secao = $stmt->fetch();
        
        if (!$secao) {
            throw new \Exception("Seção não encontrada");
        }

        return $secao;
    }

    public function atualizarTipoPermitido($secaoId, $tipo) {
        // Validar tipo de bebida
        if (!in_array($tipo, ['alcoolica', 'nao_alcoolica', null])) {
            throw new \Exception("Tipo de bebida inválido");
        }

        // Verificar se já existe algum estoque na seção
        $estoqueExistente = $this->estoqueModel->verificarVolumeEstoqueSecao($secaoId);
        
        if ($estoqueExistente > 0) {
            throw new \Exception("Não é possível alterar o tipo permitido em uma seção com estoque");
        }

        return $this->secaoModel->atualizarTipoPermitido($secaoId, $tipo);
    }

    public function obterEstoqueDaSecao($secaoId) {
        $query = "
            SELECT 
                tipo, 
                SUM(volume) as volume_total 
            FROM estoque 
            WHERE secao_id = :secao_id 
            GROUP BY tipo
        ";
        
        $stmt = $this->secaoModel->getConnection()->prepare($query);
        $stmt->bindValue(':secao_id', $secaoId);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
}