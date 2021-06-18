<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$test = realpath(__DIR__.'/../var/uploads/5ed917403dfe4ed38718556e41edbc97/docker-login.rar');


        $getID3 = new getID3;
        $fileInfo = $getID3->analyze($test);


//var_dump($fileInfo);

$fi = new FilesystemIterator(__DIR__.'/../var/uploads', FilesystemIterator::SKIP_DOTS);
var_dump(iterator_count($fi));