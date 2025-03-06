<?php

namespace Tests\Unit\Services;

use App\Services\HistoricoService;
use PHPUnit\Framework\TestCase;

class HistoricoServiceTest extends TestCase
{
    private $historicoService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->historicoService = new HistoricoService();
    }

    public function testGetAllHistorico()
    {
        $result = $this->historicoService->getAll();
        $this->assertIsArray($result);
    }

    public function testCreateHistorico()
    {
        $data = [
            'tipo' => 'Alcoólica',
            'volume' => 100,
            'secao' => 1,
            'responsavel' => 'João',
            'data' => '2023-10-01 10:00:00'
        ];
        $result = $this->historicoService->create($data);
        $this->assertIsInt($result);
    }
}