import api from './api';

export const listarBebidas = async () => {
    try {
        const response = await api.get('/bebidas');
        return response.data;
    } catch (error) {
        console.error('Erro ao listar bebidas:', error);
        throw error;
    }
};

export const cadastrarBebida = async (dados) => {
    try {
        const response = await api.post('/bebidas', dados);
        return response.data;
    } catch (error) {
        console.error('Erro ao cadastrar bebida:', error);
        throw error;
    }
};
