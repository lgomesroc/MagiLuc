<?php

namespace Tests\Unit\Controllers;

use Controllers\EstoqueController;
use PHPUnit\Framework\TestCase;

class EstoqueControllerTest extends TestCase
{
    public function testConsultarVolumeTotalPorTipo()
    {
        $controller = new EstoqueController();

        // Verifica se o método não lança exceções
        $this->expectNotToPerformAssertions();

        // Chama o método
        $controller->consultarVolumeTotalPorTipo();
    }
}