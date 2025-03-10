<?php

namespace Tests\Unit\Services;

use App\Services\BebidaService;
use PHPUnit\Framework\TestCase;
use PDOException;

class BebidaServiceTest extends TestCase
{
    private $bebidaService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->bebidaService = new BebidaService();
    }

    public function testGetAllBebidas()
    {
        $result = $this->bebidaService->getAll();
        $this->assertIsArray($result);
    }

    public function testCreateBebida()
    {
        $data = [
            'tipo' => 'Alcoólica',
            'nome' => 'Cerveja',
            'volume' => 500,
            'secao' => 1
        ];
        $result = $this->bebidaService->create($data);
        $this->assertIsInt($result);
    }

    public function testDeleteBebida()
    {
        $this->expectException(PDOException::class);
        $this->bebidaService->delete(999);
    }
}