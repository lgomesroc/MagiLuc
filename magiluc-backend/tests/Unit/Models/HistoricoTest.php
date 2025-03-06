<?php

namespace Tests\Unit\Models;

use App\Models\Historico;
use PHPUnit\Framework\TestCase;

class HistoricoTest extends TestCase
{
    public function testGetAllHistorico()
    {
        $historico = new Historico();
        $result = $historico->getAll();
        $this->assertIsArray($result);
    }
}