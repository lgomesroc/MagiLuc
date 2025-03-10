<?php

namespace Tests\Unit\Models;

use App\Models\Secao;
use PHPUnit\Framework\TestCase;

class SecaoTest extends TestCase
{
    public function testListarSecoes()
    {
        
        $secao = new Secao();

        
        $result = $secao->listarSecoes();

        
        $this->assertIsArray($result);

        
        $this->assertNotEmpty($result);
    }
}