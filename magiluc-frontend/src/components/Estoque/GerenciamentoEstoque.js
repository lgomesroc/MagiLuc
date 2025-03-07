import React, { useEffect, useState } from 'react';
import { consultarVolumeTotalPorTipo } from '../../services/estoqueService';

const GerenciamentoEstoque = () => {
    const [volumeAlcoolica, setVolumeAlcoolica] = useState(0);
    const [volumeNaoAlcoolica, setVolumeNaoAlcoolica] = useState(0);

    useEffect(() => {
        const carregarVolumes = async () => {
            try {
                const alcoolica = await consultarVolumeTotalPorTipo('alcoolica');
                const naoAlcoolica = await consultarVolumeTotalPorTipo('nao_alcoolica');
                setVolumeAlcoolica(alcoolica);
                setVolumeNaoAlcoolica(naoAlcoolica);
            } catch (error) {
                console.error('Erro ao carregar volumes:', error);
            }
        };

        carregarVolumes();
    }, []);

    return (
        <div>
            <h2>Gerenciamento de Estoque</h2>
            <p><strong>Volume Total de Bebidas Alcoólicas:</strong> {volumeAlcoolica}L</p>
            <p><strong>Volume Total de Bebidas Não Alcoólicas:</strong> {volumeNaoAlcoolica}L</p>
        </div>
    );
};

export default GerenciamentoEstoque;