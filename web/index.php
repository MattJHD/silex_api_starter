<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new App\Application('prod');

$app['debug'] = true;

$app->run();
