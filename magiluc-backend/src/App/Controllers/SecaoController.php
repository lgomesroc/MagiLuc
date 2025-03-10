<?php
namespace Controllers;

use Services\SecaoService;
use Flight;

class SecaoController {
    private $secaoService;

    public function __construct() {
        $this->secaoService = new SecaoService();
    }

    public function listarSecoes() {
        try {
            $secoes = $this->secaoService->listarSecoes();
            Flight::json($secoes);
        } catch (\Exception $e) {
            Flight::json(['erro' => $e->getMessage()], 500);
        }
    }

    public function consultarSecao($id) {
        try {
            $secao = $this->secaoService->obterSecaoPorId($id);
            Flight::json($secao);
        } catch (\Exception $e) {
            Flight::json(['erro' => $e->getMessage()], 404);
        }
    }

    public function atualizarTipoPermitido() {
        try {
            $dados = Flight::request()->data;
                        
            if (!isset($dados->secao_id) || !isset($dados->tipo)) {
                throw new \Exception("Dados incompletos para atualização");
            }

            $resultado = $this->secaoService->atualizarTipoPermitido(
                $dados->secao_id, 
                $dados->tipo
            );

            Flight::json($resultado, 200);
        } catch (\Exception $e) {
            Flight::json(['erro' => $e->getMessage()], 400);
        }
    }

    public function consultarEstoqueDaSecao($id) {
        try {
            $estoque = $this->secaoService->obterEstoqueDaSecao($id);
            Flight::json($estoque);
        } catch (\Exception $e) {
            Flight::json(['erro' => $e->getMessage()], 404);
        }
    }
}