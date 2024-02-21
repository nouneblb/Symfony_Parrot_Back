<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    #[Route('/auth', name: 'app_auth')]
    public function login(Request $request): JsonResponse

    {
        //récupérer les info d'authentication
        $credentials = json_decode($request->getContent(), true);

        // Validez les informations d'identification et générez un token JWT valide

        // Ensuite, renvoyez une réponse JSON contenant le token JWT
        return $this->json(['token' => 'your_generated_jwt_token']);
    }
}
