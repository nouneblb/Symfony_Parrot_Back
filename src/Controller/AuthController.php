<?php

namespace App\Controller;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController

{
        private $jwtManager;

    public function __construct(JWTTokenManagerInterface $jwtManager)
    {
        $this->jwtManager = $jwtManager;
    }

    public function login(UserInterface $user)
    {
        // Récupérer les rôles de l'utilisateur
        $roles = $user->getRoles();

        // Générer un token JWT avec les rôles de l'utilisateur
        $token = $this->jwtManager->create($user, ['roles' => $roles]);

        // Retourner le token JWT et les rôles dans la réponse
        return new JsonResponse(['token' => $token, 'roles' => $roles]);
    }
}
