<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'app_registration')]
    public function index(EntityManagerInterface $entityManager, Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        // Créer une instance du formulaire
        $form = $this->createForm(RegistrationFormType::class);

        // Traiter la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les données du formulaire
            $user = $form->getData();

            // Hasher le mot de passe
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $user->getPassword()
            );
            $user->setPassword($hashedPassword);

            // Enregistrer l'utilisateur en base de données
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        // Afficher le formulaire dans le template
        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
