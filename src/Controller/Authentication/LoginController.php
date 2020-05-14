<?php

namespace App\Controller\Authentication;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api_")
 */
class LoginController extends AbstractController
{
    /**
     * @Route("/login_check", name="jwt_login_check", methods={"POST"})
     */
    public function loginCheck()
    {
    }
}
