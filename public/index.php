<?php

//Display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Symfony\Component\HttpFoundation\Request;

// load vendor
require __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../public/Kernel.php';
require_once __DIR__.'/../public/Bootstrap.php';

// new kernel
$kernel = new Kernel('dev');
$bootstrap = new Bootstrap;

// new request
$request = Request::createFromGlobals();
// loader interface
$config = $kernel->registerContainerConfiguration();
// response from
$response = $bootstrap->handle($request,$config,null);