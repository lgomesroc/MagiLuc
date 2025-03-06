<?php

namespace Tests\Unit\Models;

use App\Models\Historico;
use Tests\TestCase;

class HistoricoTest extends TestCase
{
    public function testGetAllHistorico()
    {
        $historico = new Historico();
        $result = $historico->getAll();
        $this->assertIsArray($result);
    }
}