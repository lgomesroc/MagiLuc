import axios from 'axios';

const API_URL = 'http://localhost:8000';

export const listarHistorico = async () => {
    try {
        const response = await axios.get(`${API_URL}/historico`);
        return response.data;
    } catch (error) {
        console.error('Erro ao listar histórico:', error);
        throw error;
    }
};