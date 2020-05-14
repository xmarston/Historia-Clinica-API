<?php

namespace App\Controller;

use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RestController extends AbstractController
{
    public $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    protected function response(int $statusCode, $data, bool $error, string $errorMessage = ""): Response
    {
        $response = ['status' => $error ? 'error' : 'success'];

        if ($error) {
            $response['message'] = $errorMessage;
        } else {
            $response['data'] = $data;
        }

        return new Response(
            $this->serializer->serialize($response, 'json'),
            $statusCode,
            ['Content-type' => 'application/json']
        );
    }
}