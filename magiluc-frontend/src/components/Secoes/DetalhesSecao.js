import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import { consultarSecao } from '../../services/secoesService';

const DetalhesSecao = () => {
    const { id } = useParams();
    const [secao, setSecao] = useState(null);

    useEffect(() => {
        const carregarSecao = async () => {
            try {
                const dados = await consultarSecao(id);
                setSecao(dados);
            } catch (error) {
                console.error('Erro ao carregar seção:', error);
            }
        };

        carregarSecao();
    }, [id]);

    if (!secao) return <div>Carregando...</div>;

    return (
        <div>
            <h2>Detalhes da Seção</h2>
            <p><strong>Nome:</strong> {secao.nome}</p>
            <p><strong>Tipo Permitido:</strong> {secao.tipo_permitido}</p>
            <p><strong>Capacidade Alcoólica:</strong> {secao.capacidade_alcoolica}L</p>
            <p><strong>Capacidade Não Alcoólica:</strong> {secao.capacidade_nao_alcoolica}L</p>
        </div>
    );
};

export default DetalhesSecao;