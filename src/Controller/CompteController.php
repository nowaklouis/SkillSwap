<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class CompteController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entity
    ) {
    }

    #[Route('/compte', name: 'compte')]
    public function index(): Response
    {
        $user = $this->entity->getRepository(User::class)->find($this->getUser());

        return $this->render('compte.html.twig', [
            'user' => $user
        ]);
    }
}
