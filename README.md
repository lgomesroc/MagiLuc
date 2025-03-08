# Sistema de gerenciamento de estoque de bebidas - MagiLuc

Este é um sistema de gerenciamento de estoque de bebidas desenvolvido em PHP, utilizando o framework Flight para a criação de APIs RESTful. O sistema permite gerenciar o estoque de bebidas alcoólicas e não alcoólicas em um depósito com 5 seções, cada uma com capacidade específica para cada tipo de bebida.

## Funcionalidades

- **Cadastro e consulta de bebidas**: gerencie as bebidas armazenadas em cada seção.
- **Consulta de volume total por tipo**: verifique o volume total de bebidas alcoólicas e não alcoólicas no estoque.
- **Consulta de locais disponíveis**: encontre seções disponíveis para armazenar um determinado volume de bebida.
- **Consulta de seções disponíveis para venda**: verifique as seções disponíveis para venda de um determinado tipo de bebida.
- **Histórico de entradas e saídas**: registre e consulte o histórico de entradas e saídas de bebidas.
- **Regras de negócio**:
  - Uma seção não pode armazenar bebidas alcoólicas e não alcoólicas ao mesmo tempo.
  - Não há entrada ou saída de estoque sem registro no histórico.
  - Uma seção não pode receber bebidas não alcoólicas se recebeu alcoólicas no mesmo dia.

## Tecnologias utilizadas

- **Backend**: PHP, Flight PHP
- **Banco de Dados**: MySQL
- **Frontend**: React
- **Testes**: PHPUnit
- **Conteinerização**: Docker

## **MagiLuc backend**
### Estrutura do projeto
```Markdown
magiluc-backend/
├── docker-compose.yml
├── magiluc-backend
│ ├── Dockerfile
│ ├── README.md
│ ├── composer.json
│ ├── composer.lock
│ ├── config
│ │ └── database.php
│ ├── index.php
│ ├── phpunit.xml
│ ├── routes
│ │ └── api.php
│ ├── src
│ │ ├── App
│ │ │ ├── Controllers
│ │ │ │ ├── BebidasController.php
│ │ │ │ ├── EstoqueController.php
│ │ │ │ ├── HistoricoController.php
│ │ │ │ └── SecaoController.php
│ │ │ ├── Models
│ │ │ │ ├── Bebida.php
│ │ │ │ ├── Estoque.php
│ │ │ │ ├── Historico.php
│ │ │ │ └── Secao.php
│ │ │ └── Services
│ │ │ ├── BebidaService.php
│ │ │ ├── EstoqueService.php
│ │ │ ├── HistoricoService.php
│ │ │ └── SecaoService.php
│ │ └── Core
│ │ └── Interfaces
│ │ ├── ControllerInterface.php
│ │ └── ServiceInterface.php
│ ├── tests
│ │ ├── Fixtures
│ │ │ ├── bebidas.yml
│ │ │ ├── estoque.yml
│ │ │ ├── historico.yml
│ │ │ └── secoes.yml
│ │ └── Unit
│ │ ├── Controllers
│ │ │ ├── BebidasControllerTest.php
│ │ │ ├── EstoqueControllerTest.php
│ │ │ ├── HistoricoControllerTest
│ │ │ └── SecaoControllerTest.php
│ │ ├── Models
│ │ │ ├── BebidaTest.php
│ │ │ ├── EstoqueTest.php
│ │ │ ├── HistoricoTest.php
│ │ │ └── SecaoTest.php
│ │ └── Services
│ │ ├── EstoqueServiceTest.php
│ │ ├── HistoricoServiceTest.php
│ │ └── SecaoServiceTest.php
```

## Como executar o projeto

### Pré-requisitos

- PHP 8.1 ou superior
- MySQL
- Composer
- Docker

### Passos para execução

1. **Clone o repositório**:
```bash
   git clone https://bitbucket.org/lgomesroc/magiluc.git
   cd magiluc
```
2. **Instale as dependências**:

Só através via Docker.

### Configure o banco de dados:

Dentro do Docker:

1. **Crie um banco de dados MySQL**. (As queries para criar e popular o banco está mais abaixo)

2. **Configure as credenciais do banco de dados no arquivo config/database.php**.

3. **Inicie o servidor**:

```bash
php -S localhost:8000 -t public
```
## Acesse a API:

A API estará disponível somente via Docker.

## Executando com Docker
Execute o projeto usando Docker:

### Suba os contêineres:

```bash
docker-compose up -d
```
### Acesse a API:

A API estará disponível em http://localhost:8000.

## Testes
Para executar os testes unitários, utilize o PHPUnit:
```bash
./vendor/bin/phpunit tests/
```

### Criação do banco de dados

```sql
CREATE DATABASE magiluc_db;
USE magiluc_db;
```
### Criação das Tabelas
a) **Tabela secoes**
#### Armazena as seções do depósito.
```sql
CREATE TABLE secoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    tipo_permitido ENUM('alcoolica', 'nao_alcoolica') DEFAULT NULL,
    capacidade_alcoolica INT NOT NULL,
    capacidade_nao_alcoolica INT NOT NULL
);
```
b) **Tabela bebidas**
#### Armazena as bebidas.
```sql
CREATE TABLE bebidas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    tipo ENUM('alcoolica', 'nao_alcoolica') NOT NULL,
    volume DECIMAL(10, 2) NOT NULL,
    secao_id INT,
    FOREIGN KEY (secao_id) REFERENCES secoes(id)
);
```
c) **Tabela estoque**
#### Armazena o estoque de bebidas por seção.
```sql
CREATE TABLE estoque (
    id INT AUTO_INCREMENT PRIMARY KEY,
    secao_id INT NOT NULL,
    tipo ENUM('alcoolica', 'nao_alcoolica') NOT NULL,
    volume DECIMAL(10, 2) NOT NULL,
    data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (secao_id) REFERENCES secoes(id)
);
```
d) Tabela historico
#### Armazena o histórico de entradas e saídas de bebidas.
```sql
CREATE TABLE historico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    secao_id INT NOT NULL,
    tipo ENUM('alcoolica', 'nao_alcoolica') NOT NULL,
    volume DECIMAL(10, 2) NOT NULL,
    operacao ENUM('entrada', 'saida') NOT NULL,
    responsavel VARCHAR(255) NOT NULL,
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (secao_id) REFERENCES secoes(id)
);
```
3. Inserção de dados iniciais
Aqui as queries para inserir dados iniciais nas tabelas:

a) **Inserir seções**
```sql
INSERT INTO secoes (nome, tipo_permitido, capacidade_alcoolica, capacidade_nao_alcoolica) VALUES
('Seção 1', NULL, 500, 400),
('Seção 2', NULL, 500, 400),
('Seção 3', NULL, 500, 400),
('Seção 4', NULL, 500, 400),
('Seção 5', NULL, 500, 400);
```
b) **Inserir bebidas**
```sql
INSERT INTO bebidas (nome, tipo, volume, secao_id) VALUES
('Cerveja', 'alcoolica', 500, 1),
('Refrigerante', 'nao_alcoolica', 400, 2);
```
c) **Inserir estoque**
```sql
INSERT INTO estoque (secao_id, tipo, volume) VALUES
(1, 'alcoolica', 500),
(2, 'nao_alcoolica', 400);
```
d) **Inserir histórico**
```sql
INSERT INTO historico (secao_id, tipo, volume, operacao, responsavel, data) VALUES
-- Entrada de bebida alcoólica na seção 1
(1, 'alcoolica', 500, 'entrada', 'João Silva', '2023-10-01 10:00:00'),

-- Saída de bebida alcoólica na seção 1
(1, 'alcoolica', 200, 'saida', 'Maria Oliveira', '2023-10-01 12:00:00'),

-- Entrada de bebida não alcoólica na seção 2
(2, 'nao_alcoolica', 400, 'entrada', 'Carlos Souza', '2023-10-01 14:00:00'),

-- Saída de bebida não alcoólica na seção 2
(2, 'nao_alcoolica', 150, 'saida', 'Ana Pereira', '2023-10-01 16:00:00'),

-- Entrada de bebida alcoólica na seção 1
(1, 'alcoolica', 300, 'entrada', 'João Silva', '2023-10-02 09:00:00'),

-- Saída de bebida não alcoólica na seção 2
(2, 'nao_alcoolica', 100, 'saida', 'Ana Pereira', '2023-10-02 11:00:00');
```

## **MagiLuc frontend**

Este é o frontend do projeto **MagiLuc**, desenvolvido para gerenciar o armazenamento e estoque de bebidas em um depósito. O frontend foi construído com **React** e se integra a uma API RESTful desenvolvida em PHP.

### Funcionalidades

- **Gerenciamento de bebidas:**
  - Cadastro e consulta de bebidas.
  - Detalhes de cada bebida.
- **Gerenciamento de estoque:**
  - Registro de entrada e saída de bebidas.
  - Consulta do volume total por tipo de bebida.
- **Histórico de movimentações:**
  - Visualização do histórico de entradas e saídas.
- **Gerenciamento de seções:**
  - Cadastro e consulta de seções do depósito.
  - Atualização do tipo de bebida permitido em cada seção.

### Tecnologias utilizadas

- **Frontend:**
  - React
  - React Router DOM (para gerenciamento de rotas)
  - Axios (para chamadas à API)
  - Docker


### Como executar o projeto

#### Pré-requisitos

- Node.js (v16 ou superior)
- NPM ou Yarn
- Backend PHP configurado e em execução

### Passos para configuração

1. **Clone o repositório:**

   ```bash
   git clone https://github.com/seu-usuario/magiluc-frontend.git
   cd magiluc-frontend
   ```
2. **Execute o Docker**
    ```
    docker-compose up --build
    ```
    Assin instalará todas as dependências.

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

Estrutura do projeto
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

## No final do enunciado, a empresa Magics5 solicitou a minha opinião. Abaixo estão as perguntas com as respectivas respostas.

### **O que achou do desafio? (grau de dificuldade, desafios encontrados, etc.).**
Com uma dificuldade um pouco fácil o desafio, porém com vários imprevistos como erros de senhas de usuários do MySQL, configurações do Linux que começava a travar o andamento do projeto e o tempo passando, problemas em relação ao git e a criação do repositório onde me acostumo com o GitHub. Erros de código e os containers dando problemas sempre travando.


#### **Alteraria algo no desafio? O que sugeriria para avaliar melhor suas habilidades?**
Não alteraria nada no desafio. Continuava a avaliar através do teste de código para analisar as habilidades.


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
