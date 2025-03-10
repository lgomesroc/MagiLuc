<?php
require 'vendor/autoload.php';
use Flight;


ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'config/database.php';

require_once 'routes/routes.php';

Flight::start();