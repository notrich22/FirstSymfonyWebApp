<?php

// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
class InfoController
{
    public function info(): Response
    {
        return new Response(
            '<html><body>System info: '.php_uname().'</body></html>'
        );
    }
}