<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BinaryConverterController extends AbstractController
{
    #[Route('/convert-by-get', name: 'convert_by_get', methods: ['GET'])]
    public function convertByGet(Request $request): Response
    {
        $decimal = $request->query->get('decimal');
        $binary = decbin($decimal);

        return new Response($binary);
    }

    #[Route('/convert-by-post', name: 'convert_by_post', methods: ['POST'])]
    public function convertByPost(Request $request): Response
    {
        $decimal = $request->request->get('decimal');
        $binary = decbin($decimal);

        return new Response($binary);
    }

    #[Route('/convert-by-url/{decimal}', name: 'convert_by_url', methods: ['GET'])]
    public function convertByUrl(int $decimal): Response
    {
        $binary = decbin($decimal);

        return new Response($binary);
    }

    #[Route('/convert-by-json', name: 'convert_by_json', methods: ['POST'])]
    public function convertByJson(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $decimal = $data['decimal'];
        $binary = decbin($decimal);

        return new JsonResponse(['binary' => $binary]);
    }
}