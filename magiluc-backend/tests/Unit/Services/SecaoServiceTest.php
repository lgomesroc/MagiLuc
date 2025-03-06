<?php

namespace Tests\Unit\Services;

use Services\SecaoService;
use PHPUnit\Framework\TestCase;

class SecaoServiceTest extends TestCase
{
    private $secaoService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->secaoService = new SecaoService();
    }

    public function testGetAllSecoes()
    {
        $result = $this->secaoService->getAll();
        $this->assertIsArray($result);
    }

    public function testAtualizarTipoPermitido()
    {
        $result = $this->secaoService->atualizarTipoPermitido(1, 'Não Alcoólica');
        $this->assertTrue($result);
    }
}