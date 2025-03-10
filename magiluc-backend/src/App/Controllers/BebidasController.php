<?php
namespace App\Controllers;

use Models\Bebida;
use Flight;

class BebidasController {
    private $bebidaModel;

    public function __construct() {
        $this->bebidaModel = new Bebida();
    }

    public function listarBebidas() {
        try {
            $bebidas = $this->bebidaModel->getAll();
            Flight::json($bebidas);
        } catch (\Exception $e) {
            Flight::json(['erro' => $e->getMessage()], 500);
        }
    }

    public function cadastrarBebida() {
        try {
            $dados = Flight::request()->data;
                        
            if (!isset($dados->nome) || !isset($dados->tipo)) {
                throw new \Exception("Dados incompletos para cadastro");
            }

            $resultado = $this->bebidaModel->create($dados);
            Flight::json($resultado, 201);
        } catch (\Exception $e) {
            Flight::json(['erro' => $e->getMessage()], 400);
        }
    }

    public function listarBebidasInicio()
    {        
        Flight::json(['message' => 'Lista de bebidas']);
    }
}