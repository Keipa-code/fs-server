<?php

declare(strict_types=1);

use App\ErrorHandler\LogErrorHandler;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Log\LoggerInterface;
use Slim\Interfaces\CallableResolverInterface;
use Slim\Middleware\ErrorMiddleware;

return [
    ErrorMiddleware::class => static function (ContainerInterface $container): ErrorMiddleware {
        $callableResolver = $container->get(CallableResolverInterface::class);
        $responseFactory = $container->get(ResponseFactoryInterface::class);
        /**
         * @psalm-suppress MixedArrayAccess
         * @psalm-var array{
         *     displayErrorDetails:bool,
         *     logErrors:string
         * } $settings
         */
        $settings = $container->get('settings')['errors'];

        $logger = $container->get(LoggerInterface::class);

        $middleware = new ErrorMiddleware(
            $callableResolver,
            $responseFactory,
            $settings['displayErrorDetails'],
            true,
            true,
        );

        $middleware->setDefaultErrorHandler(new LogErrorHandler($callableResolver, $responseFactory, $logger));

        return $middleware;
    },

    'settings' => [
        'errors' => [
            'displayErrorDetails' => (bool)getenv('APP_DEBUG'),
        ],
    ],
];
