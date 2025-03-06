<?php

namespace Tests\Unit\Controllers;

use App\Controllers\BebidasController;
use PHPUnit\Framework\TestCase;

class BebidasControllerTest extends TestCase
{
    public function testListarBebidas()
    {
        $controller = new BebidasController();

        // Verifica se o método index não lança exceções
        $this->expectNotToPerformAssertions();

        // Chama o método index
        $controller->index();
    }
}