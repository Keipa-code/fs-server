<?php

declare(strict_types=1);

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;

return function (App $app) {

    $container = $app->getContainer();

    $app->get('/', function (RequestInterface $request, ResponseInterface $response)
    {
        return $this->get('view')->render($response, 'example.twig');
    })->add($container->get('viewMiddleware'));;

    $app->post('/', function (RequestInterface $request, ResponseInterface $response) {
        $directory = $this->get('upload_directory');
        $uploadedFiles = $request->getUploadedFiles();

        // handle single input with single file upload
        $uploadedFile = $uploadedFiles['example1'];
        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            $filename = moveUploadedFile($directory, $uploadedFile);
            $response->getBody()->write('Uploaded: ' . $filename . $uploadedFile->getClientMediaType() .'<br/>');
        }

        // handle multiple inputs with the same key
        foreach ($uploadedFiles['example2'] as $uploadedFile) {
            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                $filename = moveUploadedFile($directory, $uploadedFile);
                $response->getBody()->write('Uploaded: ' . $filename . '<br/>');
            }
        }

        // handle single input with multiple file uploads
        foreach ($uploadedFiles['example3'] as $uploadedFile) {
            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                $filename = moveUploadedFile($directory, $uploadedFile);
                $response->getBody()->write('Uploaded: ' . $filename . '<br/>');
            }
        }

        return $response;
    });



        $app->group('', function (Group $group)
        {
            $group->get('/example/{name}', function($request, $response, $args) {
                $view = 'example.twig';
                $name = $args['name'];

                return $this->get('view')->render($response, $view, compact('name'));
            });

            $group->get('/views/{name}', function ($request, $response, $args) {
                $view = 'example.twig';
                $name = $args['name'];

                return $this->get('view')->render($response, $view, compact('name'));
            });

        })->add($container->get('viewMiddleware'));


};