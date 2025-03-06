<?php
require 'vendor/autoload.php';
use Flight;

// Configurações de erro e debug
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Configuração do banco de dados
require_once 'config/database.php';

// Carregar rotas
require_once 'routes/routes.php';

// Iniciar aplicação Flight
Flight::start();