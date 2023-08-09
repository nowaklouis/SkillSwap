<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Entity\Avatar;
use App\Entity\Registered;
use App\Entity\Swap;
use App\Form\SwapFormType;
use Symfony\Component\HttpFoundation\Request;

class SwapController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entity
    ) {
    }

    #[Route('/swap/{id}', name: 'swap')]
    public function getSwap(int $id): Response
    {
        /*$user = $this->entity->getRepository(User::class)->find($this->getUser());
       
        $swapsJoineds = $this->entity->getRepository(Registered::class)->findByUsers($this->getUser());*/

        $swap = $this->entity->getRepository(Swap::class)->find($id);
        $userAuthor = $this->entity->getRepository(User::class)->find($swap->getAuthor());
        $avatarAuthor = $this->entity->getRepository(Avatar::class)->findByUser($swap->getAuthor());

        return $this->render('swap/swap.html.twig', [
            'swap' => $swap,
            'author' => $userAuthor,
            'avatarAuthor' => $avatarAuthor,
        ]);
    }

    /*#[Route('/swap-register/{id}', name: 'swap_register')]
    public function setRegister(int $id): Response
    {
        $swap = $this->entity->getRepository(Swap::class)->find($id);
        $swap->addRegister($this->getUser());

        $this->entity->flush();

        return $this->redirectToRoute('swap');
    }*/

    #[Route('/swap-edit/{id}', name: 'swap_edit')]
    public function compteEdit(int $id, Request $request): Response
    {
        $swap = $this->entity->getRepository(Swap::class)->find($id);

        if (!$swap) {
            throw $this->createNotFoundException(
                'Aucun utilisateur trouvé avec cette id: ' . $id
            );
        }

        $formEditSwap = $this->createForm(SwapFormType::class, $swap);
        $formEditSwap->handleRequest($request);

        if ($formEditSwap->isSubmitted() && $formEditSwap->isValid()) {

            $formData = $formEditSwap->getData();

            $swap->setSubject($formData->getSubject())
                ->setDescription($formData->getDescription())
                ->setDate($formData->getDate())
                ->setDuration($formData->getDuration());

            $this->entity->flush();

            $this->addFlash('success', 'Votre swap a bien été modifié !');
            return $this->redirectToRoute('compte');
        }

        return $this->render('swap/swap_edit.html.twig', [
            'form' => $formEditSwap->createView()
        ]);
    }


    #[Route('/swap-delete/{id}', name: 'swap_delete')]
    public function swapDelete(int $id): Response
    {
        $swap = $this->entity->getRepository(Swap::class)->find($id);

        if (!$swap) {
            throw $this->createNotFoundException(
                'Aucun utilisateur trouvé avec cette id: ' . $id
            );
        }
        $this->entity->remove($swap);
        $this->entity->flush();

        $this->addFlash('success', 'Votre swap a bien été supprimé !');

        return $this->redirectToRoute('compte');
    }
}
