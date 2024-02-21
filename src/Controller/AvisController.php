<?php

namespace App\Controller;
use App\Entity\Avis;
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/avis")
 */
class AvisController extends AbstractController
{
    /**
     * @Route("/", name="app_avis", methods={"GET"})
     */
    public function index(AvisRepository $avisRepository, SerializerInterface $serializer): Response
    {
        $avis = $avisRepository->findAll();
        $data = $serializer->serialize($avis, 'json');
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/{id}", name="avis_show", methods={"GET"})
     */
    public function show(Avis $avis, SerializerInterface $serializer): Response
    {
        $data = $serializer->serialize($avis, 'json');
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/", name="avis_create", methods={"POST"})
     */
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        $avis = new Avis();
        $avis->setNom($data['nom']);
        $avis->setEmail($data['email']);
        $avis->setDate(new \DateTime($data['date']));
        $avis->setNote($data['note']);
        $avis->setCommentaire($data['commentaire']);

        $entityManager->persist($avis);
        $entityManager->flush();

        return new Response(null, Response::HTTP_CREATED);
    }

    /**
     * @Route("/{id}", name="avis_update", methods={"PUT"})
     */
    public function update(Request $request, EntityManagerInterface $entityManager, Avis $avis): Response
    {
        $data = json_decode($request->getContent(), true);

        $avis->setNom($data['nom']);
        $avis->setEmail($data['email']);
        $avis->setDate(new \DateTime($data['date']));
        $avis->setNote($data['note']);
        $avis->setCommentaire($data['commentaire']);

        $entityManager->flush();

        return new Response(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/{id}", name="avis_delete", methods={"DELETE"})
     */
    public function delete(EntityManagerInterface $entityManager, Avis $avis): Response
    {
        $entityManager->remove($avis);
        $entityManager->flush();

        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}