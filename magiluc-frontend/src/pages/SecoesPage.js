import React from 'react';
import ListaSecoes from '../components/Secoes/ListaSecoes';
import CadastroSecao from '../components/Secoes/CadastroSecao';

const SecoesPage = () => {
    return (
        <div>
            <h1>Gerenciamento de Seções</h1>
            <CadastroSecao />
            <ListaSecoes />
        </div>
    );
};

export default SecoesPage;