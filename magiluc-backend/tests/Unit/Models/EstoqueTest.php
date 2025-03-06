<?php

namespace Tests\Unit\Models;

use Models\Estoque;
use PHPUnit\Framework\TestCase;

class EstoqueTest extends TestCase
{
    public function testGetAllEstoque()
    {
        $estoque = new Estoque();
        $result = $estoque->getAll();
        $this->assertIsArray($result);
    }
}