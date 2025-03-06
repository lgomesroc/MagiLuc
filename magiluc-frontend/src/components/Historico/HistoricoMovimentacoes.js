import React, { useEffect, useState } from 'react';
import { listarHistorico } from '../../services/historicoService';

const HistoricoMovimentacoes = () => {
    const [historico, setHistorico] = useState([]);

    useEffect(() => {
        const carregarHistorico = async () => {
            try {
                const dados = await listarHistorico();
                setHistorico(dados);
            } catch (error) {
                console.error('Erro ao carregar histórico:', error);
            }
        };

        carregarHistorico();
    }, []);

    return (
        <div>
            <h2>Histórico de Movimentações</h2>
            <ul>
                {historico.map((movimentacao) => (
                    <li key={movimentacao.id}>
                        <p><strong>Seção:</strong> {movimentacao.secao_id}</p>
                        <p><strong>Tipo:</strong> {movimentacao.tipo}</p>
                        <p><strong>Volume:</strong> {movimentacao.volume}L</p>
                        <p><strong>Operação:</strong> {movimentacao.operacao}</p>
                        <p><strong>Responsável:</strong> {movimentacao.responsavel}</p>
                        <p><strong>Data:</strong> {new Date(movimentacao.data).toLocaleString()}</p>
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default HistoricoMovimentacoes;