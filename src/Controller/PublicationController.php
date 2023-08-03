<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Publication;
use App\Form\CommentaireType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function showPublication(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $publication = $entityManager->find(Publication::class, $id);

        
        $commentaire = new Comment();
        $commentForm = $this->createForm(CommentaireType::class, $commentaire);

        $date = new DateTime();
        $commentaire->setCreatedAt($date);

        $commentForm->handleRequest($request);
        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            
            $commentaire->setPublication($publication);

            $entityManager->persist($commentaire);
            $entityManager->flush();

            
            return $this->redirectToRoute('app_show_publication', ['id' => $publication->getId()]);
        }

        return $this->render('publication/show.html.twig', [
            'publication' => $publication,
            'commentForm' => $commentForm->createView(), 
        ]);
    }
}
