<?php

namespace Tests\Unit\Models;

use Models\Bebida;
use PHPUnit\Framework\TestCase;

class BebidaTest extends TestCase
{
    public function testCreateBebida()
    {
        $bebida = new Bebida();
        $data = [
            'tipo' => 'Alcoólica',
            'nome' => 'Cerveja',
            'volume' => 500,
            'secao' => 1
        ];
        $result = $bebida->create($data);
        $this->assertIsInt($result);
    }
}