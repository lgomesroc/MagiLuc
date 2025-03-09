import api from './api';

export const listarSecoes = async () => {
    try {
        const response = await api.get('/secoes');
        return response.data;
    } catch (error) {
        console.error('Erro ao listar seções:', error);
        throw error;
    }
};

export const consultarSecao = async (id) => {
    try {
        const response = await api.get(`/secoes/${id}`);
        return response.data;
    } catch (error) {
        console.error('Erro ao consultar seção:', error);
        throw error;
    }
};

export const atualizarTipoPermitido = async (id, tipo) => {
    try {
        const response = await api.put('/secoes/tipo-permitido', { id, tipo });
        return response.data;
    } catch (error) {
        console.error('Erro ao atualizar tipo permitido:', error);
        throw error;
    }
};
