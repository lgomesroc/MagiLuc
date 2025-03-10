<?php

namespace Tests\Unit\Controllers;

use Controllers\SecaoController;
use PHPUnit\Framework\TestCase;

class SecaoControllerTest extends TestCase
{
    public function testListarSecoes()
    {
        $controller = new SecaoController();

        
        $this->expectNotToPerformAssertions();

        
        $controller->listarSecoes();
    }
}