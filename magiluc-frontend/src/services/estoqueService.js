import api from './api';


export const consultarVolumeTotalPorTipo = async (tipo) => {
    try {
        const response = await api.get('/estoque/volume', { params: { tipo } });
        return response.data;
    } catch (error) {
        console.error('Erro ao consultar volume total:', error);
        throw error;
    }
};

export const consultarLocaisDisponiveis = async (tipo) => {
    try {
        const response = await api.get('/estoque/locais-disponiveis', { params: { tipo } });
        return response.data;
    } catch (error) {
        console.error('Erro ao consultar locais disponíveis:', error);
        throw error;
    }
};

export const registrarEntrada = async (dados) => {
    try {
        const response = await api.post('/estoque/entrada', dados);
        return response.data;
    } catch (error) {
        console.error('Erro ao registrar entrada:', error);
        throw error;
    }
};

export const registrarSaida = async (dados) => {
    try {
        const response = await api.post('/estoque/saida', dados);
        return response.data;
    } catch (error) {
        console.error('Erro ao registrar saída:', error);
        throw error;
    }
};
