import axios from 'axios';

const API_URL = 'http://localhost:8000'; // URL do backend

export const listarSecoes = async () => {
    try {
        const response = await axios.get(`${API_URL}/secoes`);
        return response.data;
    } catch (error) {
        console.error('Erro ao listar seções:', error);
        throw error;
    }
};

export const consultarSecao = async (id) => {
    try {
        const response = await axios.get(`${API_URL}/secoes/${id}`);
        return response.data;
    } catch (error) {
        console.error('Erro ao consultar seção:', error);
        throw error;
    }
};

export const atualizarTipoPermitido = async (id, tipo) => {
    try {
        const response = await axios.put(`${API_URL}/secoes/tipo-permitido`, { id, tipo });
        return response.data;
    } catch (error) {
        console.error('Erro ao atualizar tipo permitido:', error);
        throw error;
    }
};