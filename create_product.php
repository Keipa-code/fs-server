<?php

use App\Entity\File;

require_once __DIR__."/bootstrap.php";

$newProductName = 'FUra';
$size = '128';
$uploadDate = '2018';
$authorComment = 'comm';
$preview = 'link-pre';
$link = 'link-down';




$product = new File();
$product->setFilename($newProductName);
$product->setSize($size);
$product->setUploadDate($uploadDate);
$product->setAuthorComment($authorComment);
$product->setPreview($preview);
$product->setLink($link);

$entityManager->persist($product);
$entityManager->flush();