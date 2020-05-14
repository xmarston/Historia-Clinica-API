<?php

namespace App\Controller\Authentication;

use App\Controller\RestController;
use App\Entity\User;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/api", name="api_")
 */
class RegisterController extends RestController
{
    /**
     * @Route("/register", name="register_user", methods={"POST"})
     *
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function registerUser(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();

        $user = [];
        $error = false;
        $errorMessage = "";

        try {
            $statusCode = 200;

            $name = $request->request->get('name');
            $email = $request->request->get('email');
            $password = $request->request->get('password');

            $user = new User();
            $user->setName($name);
            $user->setEmail($email);
            $user->setPassword($encoder->encodePassword($user, $password));

            $em->persist($user);
            $em->flush();
        } catch (Exception $ex) {
            $statusCode = 500;
            $error = true;
            $errorMessage = "An error has occurred trying to register the user";
        }

        return $this->response($statusCode, $user, $error, $errorMessage);
    }
}