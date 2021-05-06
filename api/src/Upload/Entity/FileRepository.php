<?php


namespace App\Upload\Entity;


interface FileRepository
{

    public function add(File $file);
}