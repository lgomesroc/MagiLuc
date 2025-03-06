<?php

namespace Tests\Unit\Controllers;

use Controllers\SecaoController;
use PHPUnit\Framework\TestCase;

class SecaoControllerTest extends TestCase
{
    public function testListarSecoes()
    {
        $controller = new SecaoController();

        // Verifica se o método não lança exceções
        $this->expectNotToPerformAssertions();

        // Chama o método listarSecoes
        $controller->listarSecoes();
    }
}