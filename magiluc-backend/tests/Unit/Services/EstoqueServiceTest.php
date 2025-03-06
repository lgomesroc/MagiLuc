<?php

namespace Tests\Unit\Services;

use App\Services\EstoqueService;
use Tests\TestCase;

class EstoqueServiceTest extends TestCase
{
    private $estoqueService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->estoqueService = new EstoqueService();
    }

    public function testConsultarVolumeTotalPorTipo()
    {
        $result = $this->estoqueService->consultarVolumeTotalPorTipo('Alcoólica');
        $this->assertIsInt($result);
    }

    public function testConsultarLocaisDisponiveis()
    {
        $result = $this->estoqueService->consultarLocaisDisponiveis(100, 'Alcoólica');
        $this->assertIsArray($result);
    }
}