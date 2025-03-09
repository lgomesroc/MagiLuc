import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000',
});

api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response) {
      const status = error.response.status;
      if (status === 404) {
        console.error('Erro 404: Recurso não encontrado');
      } else if (status === 500) {
        console.error('Erro 500: Erro interno do servidor');
      } else {
        console.error(`Erro: ${status}`);
      }
    } else {
      console.error('Erro ao realizar a requisição:', error.message);
    }
    return Promise.reject(error);
  }
);

export default api;
