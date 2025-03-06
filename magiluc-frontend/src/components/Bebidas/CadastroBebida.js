import React, { useState } from 'react';
import { cadastrarBebida } from '../../services/bebidasService';

const CadastroBebida = () => {
    const [nome, setNome] = useState('');
    const [tipo, setTipo] = useState('alcoolica');
    const [volume, setVolume] = useState(0);

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            await cadastrarBebida({ nome, tipo, volume });
            alert('Bebida cadastrada com sucesso!');
        } catch (error) {
            console.error('Erro ao cadastrar bebida:', error);
        }
    };

    return (
        <div>
            <h2>Cadastrar Bebida</h2>
            <form onSubmit={handleSubmit}>
                <input
                    type="text"
                    placeholder="Nome"
                    value={nome}
                    onChange={(e) => setNome(e.target.value)}
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
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    );
};

export default CadastroBebida;