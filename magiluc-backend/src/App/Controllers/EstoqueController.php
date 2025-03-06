<?php
namespace Controllers;

use Services\EstoqueService;
use Flight;

class EstoqueController {
    private $estoqueService;

    public function __construct() {
        $this->estoqueService = new EstoqueService();
    }

    public function consultarVolumeTotalPorTipo() {
        try {
            $volumePorTipo = $this->estoqueService->calcularVolumeTotalPorTipo();
            Flight::json($volumePorTipo);
        } catch (\Exception $e) {
            Flight::json(['erro' => $e->getMessage()], 500);
        }
    }

    public function consultarLocaisDisponiveis() {
        try {
            $tipo = Flight::request()->query['tipo'] ?? null;
            $volume = Flight::request()->query['volume'] ?? null;

            if (!$tipo || !$volume) {
                throw new \Exception("Parâmetros tipo e volume são obrigatórios");
            }

            $locaisDisponiveis = $this->estoqueService->encontrarLocaisDisponiveis($tipo, $volume);
            Flight::json($locaisDisponiveis);
        } catch (\Exception $e) {
            Flight::json(['erro' => $e->getMessage()], 400);
        }
    }

    public function registrarEntrada() {
        try {
            $dados = Flight::request()->data;
            $resultado = $this->estoqueService->registrarEntrada($dados);
            Flight::json($resultado, 201);
        } catch (\Exception $e) {
            Flight::json(['erro' => $e->getMessage()], 400);
        }
    }

    public function registrarSaida() {
        try {
            $dados = Flight::request()->data;
            $resultado = $this->estoqueService->registrarSaida($dados);
            Flight::json($resultado, 201);
        } catch (\Exception $e) {
            Flight::json(['erro' => $e->getMessage()], 400);
        }
    }
}