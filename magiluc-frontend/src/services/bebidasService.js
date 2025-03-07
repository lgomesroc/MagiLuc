import axios from 'axios';

const API_URL = 'http://localhost:8000'; // URL do backend

export const listarBebidas = async () => {
    try {
        const response = await axios.get(`${API_URL}/bebidas`);
        return response.data;
    } catch (error) {
        console.error('Erro ao listar bebidas:', error);
        throw error;
    }
};

export const cadastrarBebida = async (dados) => {
    try {
        const response = await axios.post(`${API_URL}/bebidas`, dados);
        return response.data;
    } catch (error) {
        console.error('Erro ao cadastrar bebida:', error);
        throw error;
    }
};