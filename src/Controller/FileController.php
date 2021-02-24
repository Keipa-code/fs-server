<?php


namespace App\Controller;



use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\UploadedFileInterface;


class FileController
{
    protected $view;
    protected $logger;
    protected $message;
    protected $em;  // Entities Manager
    protected $upload_directory;

    public function __construct(ContainerInterface $container)
    {
        $this->view = $container->get('view');
        $this->logger = $container->get('logger');

        $this->em = $container->get('em');
        $this->upload_directory = $container->get('settings')['upload_directory'];
    }

    protected function render(Request $request, Response $response, string $template, array $params = []): Response
    {
        return $this->view->render($response, $template, $params);
    }

    protected function moveUploadedFile(string $directory, UploadedFileInterface $uploadedFile)
    {
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);

        // see http://php.net/manual/en/function.random-bytes.php
        $basename = bin2hex(random_bytes(8));
        $filename = sprintf('%s.%0.8s', $basename, $extension);

        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

        return $filename;
    }

    public function index(Request $request, Response $response, array $args = []): Response
    {
        $this->logger->info("Home page action dispatched");

        return $this->render($request, $response, 'index.twig');
    }

    public function uploadFile(Request $request, Response $response, array $args = []): Response
    {
        $this->logger->info("Upload file using slim 4");
        $directory = $this->upload_directory;
        $uploadedFiles = $request->getUploadedFiles();

        // handle single input with multiple file uploads
        foreach ($uploadedFiles['example3'] as $uploadedFile) {
            if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                $filename = $this->moveUploadedFile($directory, $uploadedFile);
                $this->message = "Uploaded: " . $filename . "<br/>";
            }
        }

        return $this->render($request, $response, 'post.twig', ['uploaded' => $this->message]);
    }


}