<?php

namespace Tests\Unit\Controllers;

use App\Controllers\SecaoController;
use Tests\TestCase;

class SecaoControllerTest extends TestCase
{
    public function testListarSecoes()
    {
        $controller = new SecaoController();
        $this->assertNull($controller->index()); // Teste básico
    }
}