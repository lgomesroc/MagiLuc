<?php
namespace Services;

use Models\Estoque;
use App\Models\Historico;

class EstoqueService {
    private $estoqueModel;
    private $historicoModel;

    public function __construct() {
        $this->estoqueModel = new Estoque();
        $this->historicoModel = new Historico();
    }

    public function calcularVolumeTotalPorTipo() {
        return $this->estoqueModel->calcularVolumePorTipo();
    }

    public function encontrarLocaisDisponiveis($tipo, $volume) {
        $secoesDisponiveis = $this->estoqueModel->buscarSecoesDisponiveisPorTipo($tipo, $volume);
        
        if (empty($secoesDisponiveis)) {
            throw new \Exception("Não há seções disponíveis para o volume solicitado");
        }

        return $secoesDisponiveis;
    }

    public function registrarEntrada($dados) {
        // Validações de entrada
        $this->validarEntrada($dados);

        // Verificar disponibilidade de seções
        $secoesDisponiveis = $this->encontrarLocaisDisponiveis($dados->tipo, $dados->volume);

        // Registrar entrada no estoque
        $entradaEstoque = $this->estoqueModel->adicionarVolume(
            $secoesDisponiveis[0]['secao_id'], 
            $dados->tipo, 
            $dados->volume
        );

        // Registrar histórico
        $historicoEntrada = $this->historicoModel->registrarEntrada([
            'tipo' => $dados->tipo,
            'volume' => $dados->volume,
            'secao_id' => $secoesDisponiveis[0]['secao_id'],
            'responsavel' => $dados->responsavel
        ]);

        return [
            'estoque' => $entradaEstoque,
            'historico' => $historicoEntrada
        ];
    }

    public function registrarSaida($dados) {
        // Validações de saída
        $this->validarSaida($dados);

        // Registrar saída no estoque
        $saidaEstoque = $this->estoqueModel->removerVolume(
            $dados->secao_id, 
            $dados->tipo, 
            $dados->volume
        );

        // Registrar histórico
        $historicoSaida = $this->historicoModel->registrarSaida([
            'tipo' => $dados->tipo,
            'volume' => $dados->volume,
            'secao_id' => $dados->secao_id,
            'responsavel' => $dados->responsavel
        ]);

        return [
            'estoque' => $saidaEstoque,
            'historico' => $historicoSaida
        ];
    }

    private function validarEntrada($dados) {
        // Verificar se todos os campos necessários estão presentes
        if (!isset($dados->tipo, $dados->volume, $dados->responsavel)) {
            throw new \Exception("Dados incompletos para entrada");
        }

        // Validar tipo de bebida
        if (!in_array($dados->tipo, ['alcoolica', 'nao_alcoolica'])) {
            throw new \Exception("Tipo de bebida inválido");
        }

        // Verificar restrição de tipo por seção no mesmo dia
        $ultimaEntradaDia = $this->estoqueModel->buscarUltimaEntradaDia($dados->tipo);
        if ($ultimaEntradaDia) {
            throw new \Exception("Não é possível adicionar outro tipo de bebida na mesma seção no mesmo dia");
        }
    }

    private function validarSaida($dados) {
        // Verificar se todos os campos necessários estão presentes
        if (!isset($dados->tipo, $dados->volume, $dados->secao_id, $dados->responsavel)) {
            throw new \Exception("Dados incompletos para saída");
        }

        // Verificar volume disponível na seção
        $volumeDisponivel = $this->estoqueModel->verificarVolumeDisponivel($dados->secao_id, $dados->tipo);
        if ($volumeDisponivel < $dados->volume) {
            throw new \Exception("Volume indisponível para saída");
        }
    }
}