<?php

namespace App\Controller\Authentication;

use App\Entity\User;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/api", name="api_")
 */
class RegisterController extends AbstractController
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
        $message = "";

        try {
            $code = 200;
            $error = false;

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
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to register the user - Error: {$ex->getMessage()}";
        }

        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $code == 200 ? $user : $message,
        ];

        return $this->json($response);
    }
}