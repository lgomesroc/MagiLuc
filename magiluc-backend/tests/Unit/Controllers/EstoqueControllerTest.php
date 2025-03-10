<?php

namespace Tests\Unit\Controllers;

use Controllers\EstoqueController;
use PHPUnit\Framework\TestCase;

class EstoqueControllerTest extends TestCase
{
    public function testConsultarVolumeTotalPorTipo()
    {
        $controller = new EstoqueController();

        
        $this->expectNotToPerformAssertions();

        
        $controller->consultarVolumeTotalPorTipo();
    }
}