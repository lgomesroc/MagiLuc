import axios from 'axios';

const API_URL = 'http://localhost:8000';

export const consultarVolumeTotalPorTipo = async (tipo) => {
    try {
        const response = await axios.get(`${API_URL}/estoque/volume`, { params: { tipo } });
        return response.data;
    } catch (error) {
        console.error('Erro ao consultar volume total:', error);
        throw error;
    }
};

export const consultarLocaisDisponiveis = async (tipo) => {
    try {
        const response = await axios.get(`${API_URL}/estoque/locais-disponiveis`, { params: { tipo } });
        return response.data;
    } catch (error) {
        console.error('Erro ao consultar locais disponíveis:', error);
        throw error;
    }
};

export const registrarEntrada = async (dados) => {
    try {
        const response = await axios.post(`${API_URL}/estoque/entrada`, dados);
        return response.data;
    } catch (error) {
        console.error('Erro ao registrar entrada:', error);
        throw error;
    }
};

export const registrarSaida = async (dados) => {
    try {
        const response = await axios.post(`${API_URL}/estoque/saida`, dados);
        return response.data;
    } catch (error) {
        console.error('Erro ao registrar saída:', error);
        throw error;
    }
};