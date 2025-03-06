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
   ```
2. Instale as dependências:
```bash
npm install
```
ou
```bash
yarn install
```

### Configure a URL da API:

No diretório src/services/, atualize a constante API_URL em cada arquivo de serviço (bebidasService.js, estoqueService.js, etc.) com a URL do backend.

Exemplo:

```javascript
const API_URL = 'http://localhost:8000'; // URL do backend
```

### Inicie o servidor de desenvolvimento:

```bash
npm start
```
ou

```bash
yarn start
```
O frontend estará disponível em http://localhost:3000.

Estrutura do Projeto
```
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
```

## Contribuição
- Contribuições são bem-vindas! Siga os passos abaixo para contribuir:

- Faça um fork do projeto.

- Crie uma branch para sua feature (git checkout -b feature/nova-feature).

- Commit suas mudanças (git commit -m 'Adicionando nova feature').

- Push para a branch (git push origin feature/nova-feature).

- Abra um Pull Request.

## Licença
Este projeto está licenciado sob a licença MIT. Veja o arquivo LICENSE para mais detalhes.

## Contato
- Nome: Luciano Rocha

- Email: lgomesroc2012@gmail.com

- LinkedIn: linkedin.com/in/lgomesroc

- Bitbucket: bitbucket.org/lgomesroc