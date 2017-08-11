<?php
session_start();

use \QFram\Helper\Psr4AutoloaderClass;
use \QFram\Helper\PDOFactory;
use \QFram\Router;
use \QFram\HttpRequest;
use \QFram\HttpResponse;

require_once __DIR__.'/../library/QFram/helpers/Psr4AutoloaderClass.php';

// instantiate the loader
$loader = new Psr4AutoloaderClass;

// register the autoloader
$loader->register();

// register the base directories for the namespace prefix
$loader->addNamespace('QFram', __DIR__.'/../library/QFram');
$loader->addNamespace('QFram\Helper', __DIR__.'/../library/QFram/helpers');
$loader->addNamespace('Model\Object', __DIR__.'/../app/models/domain-objects');
$loader->addNamespace('Model\Mapper', __DIR__.'/../app/models/data-mappers');
$loader->addNamespace('Model\Service', __DIR__.'/../app/models/services');
$loader->addNamespace('View', __DIR__.'/../app/views');
$loader->addNamespace('Controller', __DIR__.'/../app/controllers');

new PDOFactory;
$router = new Router(new HttpRequest, new HttpResponse);
$router->run();
