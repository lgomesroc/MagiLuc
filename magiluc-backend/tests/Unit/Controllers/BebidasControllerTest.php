<?php

namespace Tests\Unit\Controllers;

use App\Controllers\BebidasController;
use PHPUnit\Framework\TestCase;

class BebidasControllerTest extends TestCase
{
    public function testListarBebidas()
    {
        $controller = new BebidasController();
        $this->assertNull($controller->index()); // Teste básico para verificar se o método existe
    }
}