<?php
require_once 'helpers/class-autoloader.php';

$router = new Router(new HTTPRequest);
$router->runController();
