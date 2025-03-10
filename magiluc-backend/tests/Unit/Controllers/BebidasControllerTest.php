<?php

namespace Tests\Unit\Controllers;

use App\Controllers\BebidasController;
use PHPUnit\Framework\TestCase;

class BebidasControllerTest extends TestCase
{
    public function testListarBebidas()
    {
        $controller = new BebidasController();

        
        $this->expectNotToPerformAssertions();

        
        $controller->listarBebidasInicio();
    }
}