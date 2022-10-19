<?php

session_start();

spl_autoload_register();
require_once  'config/common.php';
require_once 'routes/api.php';

header("Content-Type: application/json; charset=UTF-8");


