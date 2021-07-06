<?php

declare(strict_types=1);

namespace Test\Functional;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Slim\Psr7\Factory\ServerRequestFactory;

/**
 * @internal
 */
abstract class WebTestCase extends TestCase
{
    private ?App $app = null;

    protected function tearDown(): void
    {
        $this->app = null;
        parent::tearDown();
    }

    protected static function json(string $method, string $path, array $body = []): ServerRequestInterface
    {
        $request = self::request($method, $path)
            ->withHeader('Accept', 'application/json')
            ->withHeader('Content-Type', 'application/json');
        $request->getBody()->write(json_encode($body, JSON_THROW_ON_ERROR));
        return $request;
    }

    protected static function jsonWithFile(string $method, string $path, $file, array $body = []): ServerRequestInterface
    {
        return (new ServerRequestFactory())->createServerRequest($method, $path)
            //->withHeader('Accept', 'application/json')
            //->withHeader('Content-Type', 'application/json')
            ->withHeader('Tus-Resumable', '1.0.0')
            ->withHeader('Upload-Length', '70')
            ->withUploadedFiles([
                'file' => $file,
            ]);
        //$request->getBody()->write(json_encode($body, JSON_THROW_ON_ERROR));
    }

    protected static function request(string $method, string $path): ServerRequestInterface
    {
        return (new ServerRequestFactory())->createServerRequest($method, $path);
    }

    protected function app(): App
    {
        if ($this->app === null) {
            $this->app = (require __DIR__ . '/../../conf/app.php')($this->container());
        }
        return $this->app;
    }

    private function container(): ContainerInterface
    {
        /** @var ContainerInterface */
        return require __DIR__ . '/../../conf/container.php';
    }
}
