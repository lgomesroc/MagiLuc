<?php

namespace routes;

use Flight;
use App\Controllers\BebidasController;
use Controllers\EstoqueController;
use App\Controllers\HistoricoController;
use Controllers\SecaoController;

Flight::route('GET /bebidas', [new BebidasController(), 'listarBebidas']);
Flight::route('POST /bebidas', [new BebidasController(), 'cadastrarBebida']);

Flight::route('GET /secoes', [new SecaoController(), 'listarSecoes']);
Flight::route('GET /secoes/@id', [new SecaoController(), 'consultarSecao']);
Flight::route('GET /secoes/@id/estoque', [new SecaoController(), 'consultarEstoqueDaSecao']);
Flight::route('PUT /secoes/tipo-permitido', [new SecaoController(), 'atualizarTipoPermitido']);


Flight::route('GET /estoque/volume', [new EstoqueController(), 'consultarVolumeTotalPorTipo']);
Flight::route('GET /estoque/locais-disponiveis', [new EstoqueController(), 'consultarLocaisDisponiveis']);
Flight::route('POST /estoque/entrada', [new EstoqueController(), 'registrarEntrada']);
Flight::route('POST /estoque/saida', [new EstoqueController(), 'registrarSaida']);

Flight::route('GET /historico', [new HistoricoController(), 'listarHistorico']);