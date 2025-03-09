import api from './api';

export const listarHistorico = async () => {
    try {
        const response = await api.get('/historico');
        return response.data;
    } catch (error) {
        console.error('Erro ao listar histórico:', error);
        throw error;
    }
};
