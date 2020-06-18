<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ApiListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof HttpExceptionInterface) {

            $response = new JsonResponse([
                'message' => $exception->getMessage(),
            ]);

            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
            $response->headers->set('Content-Type', 'application/json');

            $event->setResponse($response);
        }
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $data = json_decode($request->getContent(), true);
            $request->request->replace(is_array($data) ? $data : array());
        }
        if ($request->isMethod('OPTIONS')) {
            $event->setResponse(new JsonResponse());
        }
    }

    public function onKernelResponse(ResponseEvent $event): void
    {
        $response = $event->getResponse();
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:8080');
        $response->headers->set('Content-Type', 'application/json');
    }
}