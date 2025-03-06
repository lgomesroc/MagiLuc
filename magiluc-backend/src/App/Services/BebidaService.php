<?php

namespace App\Services;

use Models\Bebida;
use App\Core\Interfaces\ServiceInterface; // Importação corrigida

class BebidaService implements ServiceInterface
{
    private $bebidaModel;

    public function __construct()
    {
        $this->bebidaModel = new Bebida();
    }

    public function getAll()
    {
        return $this->bebidaModel->getAll();
    }

    public function getById($id)
    {
        return $this->bebidaModel->getById($id);
    }

    public function create($data)
    {
        return $this->bebidaModel->create($data);
    }

    public function update($id, $data)
    {
        return $this->bebidaModel->update($id, $data);
    }

    public function delete($id)
    {
        return $this->bebidaModel->delete($id);
    }
}