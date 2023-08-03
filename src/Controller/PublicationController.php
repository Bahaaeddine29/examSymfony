<?php

namespace App\Controller;

use App\Entity\Publication;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublicationController extends AbstractController
{
    #[Route('/', name: 'app_publication')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $publicationRepository = $entityManager->getRepository(Publication::class);
        $publications = $publicationRepository->findAll();

        return $this->render('base.html.twig', [
            'publications' => $publications,
        ]);
    }

    #[Route('/show/{id}', name: 'app_show_publication')]
    public function showPublication(int $id, EntityManagerInterface $entityManager): Response
    {
        $publication = $entityManager->find(Publication::class, $id);


        return $this->render('publication/show.html.twig', [
            'publication' => $publication,
        ]);
    }
}
