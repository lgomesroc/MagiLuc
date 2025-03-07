import React, { useState } from 'react';
import { atualizarTipoPermitido } from '../../services/secoesService';

const CadastroSecao = () => {
    const [id, setId] = useState('');
    const [tipo, setTipo] = useState('alcoolica');

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            await atualizarTipoPermitido(id, tipo);
            alert('Tipo permitido atualizado com sucesso!');
        } catch (error) {
            console.error('Erro ao atualizar tipo permitido:', error);
        }
    };

    return (
        <div>
            <h2>Cadastrar Seção</h2>
            <form onSubmit={handleSubmit}>
                <input
                    type="number"
                    placeholder="ID da Seção"
                    value={id}
                    onChange={(e) => setId(e.target.value)}
                    required
                />
                <select value={tipo} onChange={(e) => setTipo(e.target.value)}>
                    <option value="alcoolica">Alcoólica</option>
                    <option value="nao_alcoolica">Não Alcoólica</option>
                </select>
                <button type="submit">Atualizar</button>
            </form>
        </div>
    );
};

export default CadastroSecao;