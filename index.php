<?php
require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;

$app = new Application('MineSweeper Console Game Application', 'v1.0.0');
$app->add(new \MineSweeper\Console\Greeting());
$app->run();