<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Validation;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'app_registration')]
    public function index(EntityManagerInterface $entityManager, Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        // Créer une instance du formulaire
        $form = $this->createForm(RegistrationFormType::class);

        // Traiter la soumission du formulaire
        $form->handleRequest($request);
        $error = null;

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les données du formulaire
            $user = $form->getData();

            $password = $user->getPassword();

            $validator = Validation::createValidator();
            $violations = $validator->validate($password, [
                new Length(['min' => 8]),
                new Regex([
                    'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d\S]{8,}$/',
                    'message' => 'Le mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule et un chiffre.',
                ]),
            ]);

            if (count($violations) > 0) {
                
                $error = 'Le mot de passe ne répond pas aux critères de sécurité.';

            }


            else {
                // Hasher le mot de passe
                $hashedPassword = $passwordHasher->hashPassword(
                    $user,
                    $password
                );
                $user->setPassword($hashedPassword);

                // Enregistrer l'utilisateur en base de données
                $entityManager->persist($user);
                $entityManager->flush();

                return $this->redirectToRoute('app_home');
            }
        }

        // Afficher le formulaire dans le template
        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
            'error' => $error,
        ]);
    }
}
