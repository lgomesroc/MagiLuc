<?php

namespace Tests\Unit\Models;

use App\Models\Estoque;
use Tests\TestCase;

class EstoqueTest extends TestCase
{
    public function testGetAllEstoque()
    {
        $estoque = new Estoque();
        $result = $estoque->getAll();
        $this->assertIsArray($result);
    }
}