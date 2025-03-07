import React, { useEffect, useState } from 'react';
import { listarSecoes } from '../../services/secoesService';

const ListaSecoes = () => {
    const [secoes, setSecoes] = useState([]);

    useEffect(() => {
        const carregarSecoes = async () => {
            try {
                const dados = await listarSecoes();
                setSecoes(dados);
            } catch (error) {
                console.error('Erro ao carregar seções:', error);
            }
        };

        carregarSecoes();
    }, []);

    return (
        <div>
            <h2>Lista de Seções</h2>
            <ul>
                {secoes.map((secao) => (
                    <li key={secao.id}>
                        <p><strong>Nome:</strong> {secao.nome}</p>
                        <p><strong>Tipo Permitido:</strong> {secao.tipo_permitido}</p>
                        <p><strong>Capacidade Alcoólica:</strong> {secao.capacidade_alcoolica}L</p>
                        <p><strong>Capacidade Não Alcoólica:</strong> {secao.capacidade_nao_alcoolica}L</p>
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default ListaSecoes;