<?php

namespace routes;

use Flight;
use App\Controllers\BebidasController;
use Controllers\EstoqueController;
use App\Controllers\HistoricoController;
use Controllers\SecaoController;
use Throwable;
use Exception;


Flight::map('error', function (Throwable $ex) {
    $code = $ex->getCode() ?: 500;
    Flight::json([
        'error' => true,
        'message' => $code === 500 ? 'Ocorreu um erro interno no servidor.' : $ex->getMessage(),
    ], $code);
});


Flight::route('GET /bebidas', function() {
    try {
        (new BebidasController())->listarBebidas();
    } catch (Exception $e) {
        Flight::json(['error' => true, 'message' => 'Erro ao listar bebidas.'], 500);
    }
});

Flight::route('POST /bebidas', function() {
    try {
        (new BebidasController())->cadastrarBebida();
    } catch (Exception $e) {
        Flight::json(['error' => true, 'message' => 'Erro ao cadastrar bebida.'], 500);
    }
});


Flight::route('GET /secoes', function() {
    try {
        (new SecaoController())->listarSecoes();
    } catch (Exception $e) {
        Flight::json(['error' => true, 'message' => 'Erro ao listar seções.'], 500);
    }
});

Flight::route('GET /secoes/@id', function($id) {
    try {
        (new SecaoController())->consultarSecao($id);
    } catch (Exception $e) {
        Flight::json(['error' => true, 'message' => 'Erro ao consultar seção.'], 500);
    }
});

Flight::route('PUT /secoes/tipo-permitido', function() {
    try {
        (new SecaoController())->atualizarTipoPermitido();
    } catch (Exception $e) {
        Flight::json(['error' => true, 'message' => 'Erro ao atualizar tipo permitido.'], 500);
    }
});


Flight::route('GET /estoque/volume', function() {
    try {
        (new EstoqueController())->consultarVolumeTotalPorTipo();
    } catch (Exception $e) {
        Flight::json(['error' => true, 'message' => 'Erro ao consultar volume total.'], 500);
    }
});

Flight::route('GET /estoque/locais-disponiveis', function() {
    try {
        (new EstoqueController())->consultarLocaisDisponiveis();
    } catch (Exception $e) {
        Flight::json(['error' => true, 'message' => 'Erro ao consultar locais disponíveis.'], 500);
    }
});

Flight::route('POST /estoque/entrada', function() {
    try {
        (new EstoqueController())->registrarEntrada();
    } catch (Exception $e) {
        Flight::json(['error' => true, 'message' => 'Erro ao registrar entrada no estoque.'], 500);
    }
});

Flight::route('POST /estoque/saida', function() {
    try {
        (new EstoqueController())->registrarSaida();
    } catch (Exception $e) {
        Flight::json(['error' => true, 'message' => 'Erro ao registrar saída do estoque.'], 500);
    }
});


Flight::route('GET /historico', function() {
    try {
        (new HistoricoController())->index();
    } catch (Exception $e) {
        Flight::json(['error' => true, 'message' => 'Erro ao listar histórico.'], 500);
    }
});


Flight::map('notFound', function() {
    Flight::json([
        'error' => true,
        'message' => 'Rota não encontrada.'
    ], 404);
});
