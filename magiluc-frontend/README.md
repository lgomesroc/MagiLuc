# MagiLuc Frontend

Este é o frontend do projeto **MagiLuc**, desenvolvido para gerenciar o armazenamento e estoque de bebidas em um depósito. O frontend foi construído com **React** e se integra a uma API RESTful desenvolvida em PHP.

## Funcionalidades

- **Gerenciamento de Bebidas:**
  - Cadastro e consulta de bebidas.
  - Detalhes de cada bebida.
- **Gerenciamento de Estoque:**
  - Registro de entrada e saída de bebidas.
  - Consulta do volume total por tipo de bebida.
- **Histórico de Movimentações:**
  - Visualização do histórico de entradas e saídas.
- **Gerenciamento de Seções:**
  - Cadastro e consulta de seções do depósito.
  - Atualização do tipo de bebida permitido em cada seção.

## Tecnologias Utilizadas

- **Frontend:**
  - React
  - React Router DOM (para gerenciamento de rotas)
  - Axios (para chamadas à API)
- **Backend:**
  - PHP
  - Flight PHP (para criação da API)
  - MySQL (banco de dados)

## Como Executar o Projeto

### Pré-requisitos

- Node.js (v16 ou superior)
- NPM ou Yarn
- Backend PHP configurado e em execução

### Passos para Configuração

1. **Clone o repositório:**

   ```bash
   git clone https://github.com/seu-usuario/magiluc-frontend.git
   cd magiluc-frontend
Instale as dependências:

bash
Copy
npm install
ou

bash
Copy
yarn install
Configure a URL da API:

No diretório src/services/, atualize a constante API_URL em cada arquivo de serviço (bebidasService.js, estoqueService.js, etc.) com a URL do backend.

Exemplo:

javascript
Copy
const API_URL = 'http://localhost:8000'; // URL do backend
Inicie o servidor de desenvolvimento:

bash
Copy
npm start
ou

bash
Copy
yarn start
O frontend estará disponível em http://localhost:3000.

Estrutura do Projeto
Copy
magiluc-frontend/
├── public/
├── src/
│   ├── components/
│   │   ├── Bebidas/
│   │   │   ├── CadastroBebida.js
│   │   │   ├── DetalhesBebida.js
│   │   │   └── ListaBebidas.js
│   │   ├── Estoque/
│   │   │   ├── EntradaEstoque.js
│   │   │   ├── GerenciamentoEstoque.js
│   │   │   └── SaidaEstoque.js
│   │   ├── Historico/
│   │   │   └── HistoricoMovimentacoes.js
│   │   └── Secoes/
│   │       ├── CadastroSecao.js
│   │       ├── DetalhesSecao.js
│   │       └── ListaSecoes.js
│   ├── pages/
│   │   ├── BebidasPage.js
│   │   ├── Dashboard.js
│   │   ├── EstoquePage.js
│   │   ├── HistoricoPage.js
│   │   └── SecoesPage.js
│   ├── services/
│   │   ├── bebidasService.js
│   │   ├── estoqueService.js
│   │   ├── historicoService.js
│   │   └── secoesService.js
│   ├── App.js
│   ├── index.js
│   └── index.css
├── package.json
└── README.md