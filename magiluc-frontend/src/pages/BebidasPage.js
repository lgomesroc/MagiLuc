import React from 'react';
import ListaBebidas from '../components/Bebidas/ListaBebidas';
import CadastroBebida from '../components/Bebidas/CadastroBebida';

const BebidasPage = () => {
    return (
        <div>
            <h1>Gerenciamento de Bebidas</h1>
            <CadastroBebida />
            <ListaBebidas />
        </div>
    );
};

export default BebidasPage;