<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('BASE_URL', 'http://localhost/68PM4_01_longlt_0016668/longlt_0016668_CK/public');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'longlt_0016668_DB');
define('X', 6);
define('Y', 6);
define('PAGE_SIZES', [Y+2, Y+5, Y+10]); 

require_once __DIR__ . '/../app/core/DB.php';
require_once __DIR__ . '/../app/core/Controller.php';
require_once __DIR__ . '/../app/core/App.php';

new App();