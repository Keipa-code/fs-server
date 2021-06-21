<?php

declare(strict_types=1);

use App\Factory\Thumb;

require __DIR__ . '/../vendor/autoload.php';

$test = realpath(__DIR__.'/Thumbs.php');

$getID3 = new getID3;
$fullInfo = $getID3->analyze($test);

var_dump($fullInfo);