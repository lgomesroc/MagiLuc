<?php

namespace Tests\Unit\Models;

use Models\Secao;
use PHPUnit\Framework\TestCase;

class SecaoTest extends TestCase
{
    public function testListarSecoes()
    {
        // Cria uma instância da classe Secao
        $secao = new Secao();

        // Chama o método listarSecoes
        $result = $secao->listarSecoes();

        // Verifica se o resultado é um array
        $this->assertIsArray($result);

        // Verifica se o array não está vazio (opcional)
        $this->assertNotEmpty($result);
    }
}