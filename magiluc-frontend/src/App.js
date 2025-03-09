import React from 'react';
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import BebidasPage from './pages/BebidasPage';
import EstoquePage from './pages/EstoquePage';
import HistoricoPage from './pages/HistoricoPage';
import SecoesPage from './pages/SecoesPage';
import Dashboard from './pages/Dashboard';

const NotFoundPage = () => <h1>Página não encontrada (404)</h1>;

const App = () => {
    return (
        <Router>
            <Routes>
                <Route path="/" element={<Dashboard />} />
                <Route path="/bebidas" element={<BebidasPage />} />
                <Route path="/estoque" element={<EstoquePage />} />
                <Route path="/historico" element={<HistoricoPage />} />
                <Route path="/secoes" element={<SecoesPage />} />
                <Route path="*" element={<NotFoundPage />} /> {/* Tratamento 404 */}
            </Routes>
        </Router>
    );
};

export default App;
