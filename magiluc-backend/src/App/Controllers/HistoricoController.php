<?php

namespace App\Controllers;

use App\Services\HistoricoService;
use App\Core\Interfaces\ControllerInterface;
use Flight;

class HistoricoController implements ControllerInterface
{
    private $historicoService;

    public function __construct()
    {
        $this->historicoService = new HistoricoService();
    }

    public function index()
    {
        $historico = $this->historicoService->getAll();
        Flight::json($historico);
    }

    public function show($id)
    {
        $historico = $this->historicoService->getById($id);
        Flight::json($historico);
    }

    public function store()
    {
        $data = Flight::request()->data->getData();
        $historico = $this->historicoService->create($data);
        Flight::json($historico, 201);
    }

    public function update($id)
    {
        $data = Flight::request()->data->getData();
        $historico = $this->historicoService->update($id, $data);
        Flight::json($historico);
    }

    public function destroy($id)
    {
        $this->historicoService->delete($id);
        Flight::json(['message' => 'Histórico deletado com sucesso']);
    }
}