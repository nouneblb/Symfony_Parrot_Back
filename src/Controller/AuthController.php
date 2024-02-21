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

    /**
     * @Route("/login", name="app_login", methods={"POST"})
     */
    public function login(Request $request): JsonResponse
    {
        // Récupérer les informations d'identification depuis la requête
        $credentials = json_decode($request->getContent(), true);

        // Valider les informations d'identification et récupérer l'utilisateur
        // Ceci est un exemple, vous devez implémenter votre propre logique d'authentification
        $user = $this->getUser();

        if (!$user) {
            return $this->json(['error' => 'Invalid credentials'], 401);
        }

        // Récupérer les rôles de l'utilisateur
        $roles = $user->getRoles();

        // Générer un token JWT avec les rôles de l'utilisateur
        $token = $this->jwtManager->create($user, ['roles' => $roles]);

        // Retourner le token JWT dans la réponse
        return $this->json(['token' => $token]);
    }

    /**
     * @Route("/auth", name="app_auth", methods={"POST"})
     */
    public function authenticate(Request $request): JsonResponse
    {
        // Récupérer les informations d'identification depuis la requête
        $credentials = json_decode($request->getContent(), true);

        // Valider les informations d'identification et générer un token JWT valide

        // Ensuite, renvoyer une réponse JSON contenant le token JWT
        return $this->json(['token' => 'your_generated_jwt_token']);
    }
}