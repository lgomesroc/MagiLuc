<?php

namespace App\Services;

use App\Models\Historico;
use App\Core\Interfaces\ServiceInterface;


class HistoricoService implements ServiceInterface
{
    private $historicoModel;

    public function __construct()
    {
        $this->historicoModel = new Historico();
    }

    public function getAll()
    {
        return $this->historicoModel->getAll();
    }

    public function getById($id)
    {
        return $this->historicoModel->getById($id);
    }

    public function create($data)
    {
        return $this->historicoModel->create($data);
    }

    public function update($id, $data)
    {
        return $this->historicoModel->update($id, $data);
    }

    public function delete($id)
    {
        return $this->historicoModel->delete($id);
    }
}