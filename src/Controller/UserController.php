<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Entity\User;

class UserController extends AbstractController
{
    #[Route('/api/users', name: 'create_user', methods: ['POST'])]
    public function createUser(Request $request, Security $security): JsonResponse
    {
        // Vérifiez si l'utilisateur actuel est authentifié et s'il a le rôle d'administrateur
        if (!$security->isGranted('ROLE_ADMIN')) {
            // Retournez une réponse indiquant que l'utilisateur n'est pas autorisé
            return new JsonResponse(['error' => 'Vous n\'êtes pas autorisé à effectuer cette action.'], 403);
        }

        // Récupérez les données du corps de la requête pour créer un nouvel utilisateur
        $data = json_decode($request->getContent(), true);

        // Créez un nouvel utilisateur avec les données fournies
        // Ici, vous pouvez implémenter la logique pour créer un nouvel utilisateur dans votre système

        // Retournez une réponse indiquant que l'utilisateur a été créé avec succès
        return new JsonResponse(['message' => 'Utilisateur créé avec succès.'], 201);
    }
}
