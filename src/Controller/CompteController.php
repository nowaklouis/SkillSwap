<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Entity\Skill;
use App\Entity\Interest;
use App\Entity\Avatar;
use App\Entity\Registered;
use App\Entity\Swap;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EditCompteType;
use App\Form\InterestFormType;
use App\Form\SkillFormType;
use App\Form\AvatarFormType;
use App\Form\SwapFormType;

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
        $avatar = $this->entity->getRepository(Avatar::class)->findByUser($this->getUser());
        $swaps = $this->entity->getRepository(Swap::class)->findByAuthor($this->getUser());
        $swapsJoineds = $this->entity->getRepository(Registered::class)->findByUsers($this->getUser());

        return $this->render('compte/compte.html.twig', [
            'user' => $user,
            'avatar' => $avatar,
            'swaps' => $swaps,
            'swapsJoineds' => $swapsJoineds,
        ]);
    }

    #[Route('/compte/edit/{id}', name: 'compte_edit')]
    public function compteEdit(int $id, Request $request): Response
    {
        $user = $this->entity->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'Aucun utilisateur trouvé avec cette id: ' . $id
            );
        }

        $form = $this->createForm(EditCompteType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formData = $form->getData();

            $user->setEmail($formData->getEmail())
                ->setUsername($formData->getUsername())
                ->setDateOfBirth($formData->getDateOfBirth())
                ->setDescription($formData->getDescription());

            $this->entity->flush();

            $this->addFlash('success', 'Votre compte a bien été modifié !');
            return $this->redirectToRoute('compte');
        }

        return $this->render('compte/compte_edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/compte-skill', name: 'compte_skill')]
    public function compteSkill(Request $request): Response
    {
        $skill = new Skill();

        $formSkill = $this->createForm(SkillFormType::class, $skill);
        $formSkill->handleRequest($request);

        if ($formSkill->isSubmitted() && $formSkill->isValid()) {
            $skill->setUser($this->getUser());

            $this->entity->persist($skill);
            $this->entity->flush();

            $this->addFlash('success', 'Votre compétence a bien été ajouté !');

            return $this->redirectToRoute('compte_skill');
        }

        $skills = $this->entity->getRepository(Skill::class)->findByUser($this->getUser());

        return $this->render('compte/compte_skill.html.twig', [
            'form' => $formSkill->createView(),
            'skills' => $skills,
        ]);
    }

    #[Route('/compte/skill-delete/{id}', name: 'skill_delete')]
    public function skillDelete(int $id): Response
    {
        $skill = $this->entity->getRepository(Skill::class)->find($id);

        if (!$skill) {
            throw $this->createNotFoundException(
                'Aucun utilisateur trouvé avec cette id: ' . $id
            );
        }
        $this->entity->remove($skill);
        $this->entity->flush();

        $this->addFlash('success', 'Votre competence a bien été supprimé !');

        return $this->redirectToRoute('compte_skill');
    }

    #[Route('/compte-interest', name: 'compte_interest')]
    public function compteInterest(Request $request): Response
    {
        $interest = new Interest();

        $formInterest = $this->createForm(InterestFormType::class, $interest);
        $formInterest->handleRequest($request);

        if ($formInterest->isSubmitted() && $formInterest->isValid()) {
            $interest->setUser($this->getUser());

            $this->entity->persist($interest);
            $this->entity->flush();

            $this->addFlash('success', 'Votre matiere intéressé a bien été ajouté !');

            return $this->redirectToRoute('compte_interest');
        }

        $interests = $this->entity->getRepository(Interest::class)->findByUser($this->getUser());

        return $this->render('compte/compte_interest.html.twig', [
            'form' => $formInterest->createView(),
            'interests' => $interests,
        ]);
    }

    #[Route('/compte/interest-delete/{id}', name: 'interest_delete')]
    public function interestDelete(int $id): Response
    {
        $interest = $this->entity->getRepository(Interest::class)->find($id);

        if (!$interest) {
            throw $this->createNotFoundException(
                'Aucun utilisateur trouvé avec cette id: ' . $id
            );
        }
        $this->entity->remove($interest);
        $this->entity->flush();

        $this->addFlash('success', 'Votre matiere intéressé a bien été supprimé !');

        return $this->redirectToRoute('compte_interest');
    }

    #[Route('/compte-avatar', name: 'compte_avatar')]
    public function compteAvatar(Request $request): Response
    {
        $avatar = new Avatar();

        $form = $this->createForm(AvatarFormType::class, $avatar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $avatar->setUser($this->getUser());

            $this->entity->persist($avatar);
            $this->entity->flush();

            $this->addFlash('success', 'Votre avatar a bien été modifié !');
            return $this->redirectToRoute('compte');
        }

        return $this->render('compte/compte_avatar.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/compte-swap', name: 'compte_swap')]
    public function compteSwap(Request $request): Response
    {
        $swap = new Swap();

        $formSwap = $this->createForm(SwapFormType::class, $swap);
        $formSwap->handleRequest($request);

        if ($formSwap->isSubmitted() && $formSwap->isValid()) {
            $swap->setAuthor($this->getUser());

            $this->entity->persist($swap);
            $this->entity->flush();

            $this->addFlash('success', 'Votre Swap a bien été ajouté !');

            return $this->redirectToRoute('compte');
        }

        return $this->render('compte/compte_swap.html.twig', [
            'form' => $formSwap->createView(),
        ]);
    }

    #[Route('/user/{id}', name: 'other_compte')]
    public function otherCompte(int $id): Response
    {
        $user = $this->entity->getRepository(User::class)->find($id);
        $avatar = $this->entity->getRepository(Avatar::class)->findByUser($id);
        $skills = $this->entity->getRepository(Skill::class)->findByUser($id);

        return $this->render('compte/compte_other.html.twig', [
            'user' => $user,
            'avatar' => $avatar,
            'skills' => $skills
        ]);
    }
}
