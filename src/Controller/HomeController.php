<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Entity\Reference;
use App\Entity\ReferenceGenre;
use App\Repository\ReferenceRepository;
use Doctrine\Entity;
use Doctrine\ORM\EntityManagerInterface;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/like/{action}', name: 'app_like')]
    public function like(\Symfony\Component\HttpFoundation\Request $request, EntityManagerInterface $entityManager, $action): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true); // Récupérer les données JSON en tant que tableau associatif
        $entityManagerReference = $entityManager->getRepository(Reference::class);
//        var_dump($requestData);
        $id = !empty($requestData["id"]) ? $requestData["id"] : "";
        $genre = !empty($requestData["genre"]) ? $requestData["genre"] : "";
        if($genre) {
            $newGenre = $entityManager->getRepository(Genre::class)->findOneBy(["name" => $genre]);
            if($newGenre == null){
                $newGenre = new Genre();
                $newGenre->setName($genre);
                $entityManager->persist($newGenre);
            }
        }
        $entityManagerReferenceGenre = $entityManager->getRepository(ReferenceGenre::class);
//        $entityManagerReferenceArtiste = $entityManager->getRepository(Reference::class);
//        $entityManagerReferenceFormat = $entityManager->getRepository(Reference::class);
//        $entityManagerReferenceFruit = $entityManager->getRepository(Reference::class);
        $reference = $entityManagerReference->findOneBy(["discogsId" => $id]);
        if($reference == null) {
            $reference = new Reference();
            $reference->setDiscogsId($id);
            $reference->setTitle("test");
            $entityManager->persist($reference);
        }
        if($entityManagerReferenceGenre->findOneBy(["reference" => $reference,"genre" =>  $newGenre]) == null) {
//            var_dump("test");
            $referenceGenre = new ReferenceGenre();
            $referenceGenre->setReference($reference);
            $referenceGenre->setGenre($newGenre);
            $entityManager->persist($referenceGenre);
        }

        $entityManagerReferenceUser = $entityManager->getRepository(ReferenceUser::class);
        $referenceUser = $entityManagerReferenceUser->findOneBy(["reference" => $reference, "user" => $this->getUser()]);

        if ($referenceUser == null) {
            $referenceUser = new ReferenceUser();
            $referenceUser->setReference($reference);
            $referenceUser->setUser($this->getUser());
            $entityManager->persist($referenceUser);
        }

//        $entityManagerReferenceUser = $entityManager->getRepository(Refer::class);
        $entityManager->flush();
        return new JsonResponse(['success' => true, 'id' => $id, 'action' => $action]);
    }



}
