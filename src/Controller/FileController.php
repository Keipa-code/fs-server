<?php


namespace App\Controller;


use App\Application\Thumbs;
use App\Entity\File;
use DateTime;
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

    protected function createThumbs($file)
    {
        $thumb = new Thumbs($file);
        $thumb->resize(200,0);
        $thumbFile = $thumb->output();
        return $thumbFile;
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
            $file = new File();
            var_dump($uploadedFiles['example3']);
            // handle single input with multiple file uploads
            foreach ($uploadedFiles['example3'] as $uploadedFile) {
                if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                    $file->setFilename($uploadedFile->getClientFilename());
                    $file->setSize($uploadedFile->getSize());
                    if (isset($args['authorComment'])) {
                        $file->setAuthorComment($args['authorComment']);
                    }
                    $filename = $this->moveUploadedFile($directory, $uploadedFile);
                    $file->setLink($filename);
                    $file->setPreview($uploadedFile->getClientMediaType());
                    $file->setUploadDate(new DateTime("now"));

                    $this->message = "Uploaded: " . $filename . "<br/>";
                    $this->em->persist($file);

                }
                $this->em->flush();
            }


        return $this->render($request, $response, 'post.twig', ['upload' => $this->message]);
    }
    public function downloadFile(Request $request, Response $response, array $args = []): Response
    {
        $file = $this->em->find('App\Entity\File', intval($args['id']));
        return $this->render($request, $response, 'file.twig', ['file' => $file]);
        $qwe = new Thumb;
    }
}