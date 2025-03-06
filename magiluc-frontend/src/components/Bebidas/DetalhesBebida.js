import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import { consultarSecao } from '../../services/secoesService';

const DetalhesBebida = () => {
    const { id } = useParams();
    const [bebida, setBebida] = useState(null);

    useEffect(() => {
        const carregarBebida = async () => {
            try {
                const dados = await consultarSecao(id);
                setBebida(dados);
            } catch (error) {
                console.error('Erro ao carregar bebida:', error);
            }
        };

        carregarBebida();
    }, [id]);

    if (!bebida) return <div>Carregando...</div>;

    return (
        <div>
            <h2>Detalhes da Bebida</h2>
            <p><strong>Nome:</strong> {bebida.nome}</p>
            <p><strong>Tipo:</strong> {bebida.tipo}</p>
            <p><strong>Volume:</strong> {bebida.volume}L</p>
            <p><strong>Seção:</strong> {bebida.secao_id}</p>
        </div>
    );
};

export default DetalhesBebida;