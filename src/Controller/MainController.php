<?php
namespace App\Controller;

use mysql_xdevapi\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/ping')]
    public function ping(): Response
    {
        return new Response("pong");
    }
    #[Route('/timepage')]
    public function time(): Response
    {
        $time = date("H:i:s");

        return $this->render('timepage.html.twig', [
            'time' => $time,
        ]);
    }
    #[Route("/info")]
    public function info(): Response
    {
        return new Response(
            '<html><body>System info: ' . php_uname() . '</body></html>'
        );
    }
    #[Route("/fact/{number}")]
    public function fact($number):JsonResponse
    {
        try{
            $numToFactorize = $number;
            $factorization = function($number) {

                if(!is_numeric($number)){
                    throw new \Exception("Number не integer, аргумент должен быть типа integer!");
                }
                $multipliers = [1];
                for ($mul = 2; $number != 1; ) {
                    if ($number % $mul == 0) {
                        $multipliers[] = $mul;
                        $number /= $mul;
                    } else {
                        $mul++;
                    }
                }
                return $multipliers;
            };

            $res = $factorization($numToFactorize);
            //$resJSON = json_encode($numToFactorize.$res);
            $resArray =
                ['Number to factorize' => $numToFactorize,
                'Divisors' => $res];
            return new JsonResponse($resArray);
        }catch (\Throwable $err){
            return new JsonResponse("Возникла ошибка! Текст ошибки: ".$err->getMessage());
        }
    }
}