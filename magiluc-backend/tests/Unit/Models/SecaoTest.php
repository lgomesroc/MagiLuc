<?php

namespace Tests\Unit\Models;

use App\Models\Secao;
use Tests\TestCase;

class SecaoTest extends TestCase
{
    public function testGetAllSecoes()
    {
        $secao = new Secao();
        $result = $secao->getAll();
        $this->assertIsArray($result);
    }
}