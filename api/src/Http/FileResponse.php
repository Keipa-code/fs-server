<?php

declare(strict_types=1);


namespace App\Http;


use Slim\Psr7\Headers;
use Slim\Psr7\Response;

class FileResponse extends Response
{
    public function __construct(int $status = \Fig\Http\Message\StatusCodeInterface::STATUS_OK, ?\Slim\Psr7\Interfaces\HeadersInterface $headers = null, ?\Psr\Http\Message\StreamInterface $body = null)
    {
        parent::__construct(
            $status,
            new Headers([
                'Content-Type' => 'application/force-download',
                'Content-Type' => 'application/octet-stream',
                'Content-Type' => 'application/download',
                'Content-Description' => 'File Transfer',
                'Content-Transfer-Encoding' => 'binary',
                'Content-Disposition' => 'attachment; filename="' . basename($file) . '"',
                'Expires' => '0',
                'Content-Length' => filesize($file),
                'Cache-Control' => 'must-revalidate',
                'Pragma' => 'public',
            ]),
            $body);
    }
}