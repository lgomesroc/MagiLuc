import React, { useEffect, useState } from 'react';
import { listarBebidas } from '../../services/bebidasService';

const ListaBebidas = () => {
    const [bebidas, setBebidas] = useState([]);

    useEffect(() => {
        const carregarBebidas = async () => {
            try {
                const dados = await listarBebidas();
                setBebidas(dados);
            } catch (error) {
                console.error('Erro ao carregar bebidas:', error);
            }
        };

        carregarBebidas();
    }, []);

    return (
        <div>
            <h2>Lista de Bebidas</h2>
            <ul>
                {bebidas.map((bebida) => (
                    <li key={bebida.id}>
                        {bebida.nome} - {bebida.tipo} - {bebida.volume}L
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default ListaBebidas;