import React from 'react';
import { Link } from 'react-router-dom';

const Dashboard = () => {
    return (
        <div>
            <h1>Dashboard</h1>
            <nav>
                <ul>
                    <li><Link to="/bebidas">Gerenciar Bebidas</Link></li>
                    <li><Link to="/estoque">Gerenciar Estoque</Link></li>
                    <li><Link to="/historico">Histórico de Movimentações</Link></li>
                    <li><Link to="/secoes">Gerenciar Seções</Link></li>
                </ul>
            </nav>
        </div>
    );
};

export default Dashboard;