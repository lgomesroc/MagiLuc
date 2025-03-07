import React from 'react';
import GerenciamentoEstoque from '../components/Estoque/GerenciamentoEstoque';
import EntradaEstoque from '../components/Estoque/EntradaEstoque';
import SaidaEstoque from '../components/Estoque/SaidaEstoque';

const EstoquePage = () => {
    return (
        <div>
            <h1>Gerenciamento de Estoque</h1>
            <GerenciamentoEstoque />
            <EntradaEstoque />
            <SaidaEstoque />
        </div>
    );
};

export default EstoquePage;