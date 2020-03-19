<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login/google", name="api_login_google")
     */
    public function loginGoogle()
    {
        return $this->json(true);
    }
}
