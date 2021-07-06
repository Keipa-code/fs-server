<?php

declare(strict_types=1);

namespace App\Http\Test\Middleware;

use App\Http\Middleware\ValidationExceptionHandler;
use App\Http\Validator\ValidationException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Factory\ServerRequestFactory;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;

/**
 * @covers \App\Http\Middleware\ValidationExceptionHandler
 *
 * @internal
 */
final class ValidationExceptionHandlerTest extends TestCase
{
    public function testNormal(): void
    {
        $middleware = new ValidationExceptionHandler();

        $handler = $this->createStub(RequestHandlerInterface::class);
        $handler->method('handle')->willReturn($source = (new ResponseFactory())->createResponse());

        $request = (new ServerRequestFactory())->createServerRequest('POST', 'http://test');
        $response = $middleware->process($request, $handler);

        self::assertEquals($source, $response);
    }

    public function testException(): void
    {
        $middleware = new ValidationExceptionHandler();

        $violations = new ConstraintViolationList([
            new ConstraintViolation('Incorrect Email', null, [], null, 'email', 'not-email'),
            new ConstraintViolation('Empty Password', null, [], null, 'password', ''),
        ]);

        $handler = $this->createStub(RequestHandlerInterface::class);
        $handler->method('handle')->willThrowException(new ValidationException($violations));

        $request = (new ServerRequestFactory())->createServerRequest('POST', 'http://test');
        $response = $middleware->process($request, $handler);

        self::assertEquals(422, $response->getStatusCode());
        self::assertJson($body = (string)$response->getBody());

        /** @var array $data */
        $data = json_decode($body, true, 512, JSON_THROW_ON_ERROR);

        self::assertEquals([
            'errors' => [
                'email' => 'Incorrect Email',
                'password' => 'Empty Password',
            ],
        ], $data);
    }
}
