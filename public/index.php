<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Application;

$app = new Application();
$app->start();

echo "$app\n";
