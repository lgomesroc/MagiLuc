import React, { useState } from 'react';
import { registrarEntrada } from '../../services/estoqueService';

const EntradaEstoque = () => {
    const [secaoId, setSecaoId] = useState('');
    const [tipo, setTipo] = useState('alcoolica');
    const [volume, setVolume] = useState(0);
    const [responsavel, setResponsavel] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            await registrarEntrada({ secao_id: secaoId, tipo, volume, responsavel });
            alert('Entrada registrada com sucesso!');
        } catch (error) {
            console.error('Erro ao registrar entrada:', error);
        }
    };

    return (
        <div>
            <h2>Registrar Entrada no Estoque</h2>
            <form onSubmit={handleSubmit}>
                <input
                    type="number"
                    placeholder="ID da Seção"
                    value={secaoId}
                    onChange={(e) => setSecaoId(e.target.value)}
                    required
                />
                <select value={tipo} onChange={(e) => setTipo(e.target.value)}>
                    <option value="alcoolica">Alcoólica</option>
                    <option value="nao_alcoolica">Não Alcoólica</option>
                </select>
                <input
                    type="number"
                    placeholder="Volume"
                    value={volume}
                    onChange={(e) => setVolume(e.target.value)}
                    required
                />
                <input
                    type="text"
                    placeholder="Responsável"
                    value={responsavel}
                    onChange={(e) => setResponsavel(e.target.value)}
                    required
                />
                <button type="submit">Registrar</button>
            </form>
        </div>
    );
};

export default EntradaEstoque;