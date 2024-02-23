<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\AlbumFormat;
use App\Entity\AlbumFruit;
use App\Entity\AlbumGenre;
use App\Entity\Artiste;
use App\Entity\ArtisteFruit;
use App\Entity\Format;
use App\Entity\Fruit;
use App\Entity\Genre;
use App\Entity\RechercheFruit;
use App\Entity\UserAlbum;
use App\Entity\UserArtiste;
use App\Form\FruitFormType;
use App\Service\ApiDiscogsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $entityManagerUserAlbum = $entityManager->getRepository(UserAlbum::class);
        $entityManagerUserArtist = $entityManager->getRepository(UserArtiste::class);
        $resultsArtists = $entityManagerUserArtist->findBy(["user" => $this->getUser()]);
        $arrayArtists = array();
        foreach ($resultsArtists as $item) {
            $artist = $item->getArtiste();
            $arrayArtists[] = array("id" => $artist->getDiscogsId(), "name" => $artist->getName());
            unset($artist);
        }
        $resultsAlbums = $entityManagerUserAlbum->findBy(["user" => $this->getUser()]);
        $arrayAlbums = array();
        foreach ($resultsAlbums as $item) {
            $album = $item->getAlbum();
            $arrayAlbums[] = array("id" => $album->getDiscogsId(), "title" => $album->getTitle());
            unset($album);
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController', 'resultsArtistes' => $arrayArtists, 'resultsAlbums' => $arrayAlbums
        ]);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    #[Route('/search', name: 'app_search')]
    public function search(\Symfony\Component\HttpFoundation\Request $request, EntityManagerInterface $entityManager, ApiDiscogsService $apiDiscogsService, string $S_type = 'master'): Response
    {
        $rechercheFruit = new RechercheFruit();
        if ($request->get('fruitId') != null) {
            $fruit = $entityManager->getRepository(Fruit::class)->find($request->get('fruitId'));
            $rechercheFruit->setFruit($fruit);
        } else {
            $fruit = $entityManager->getRepository(Fruit::class)->findOneBy(["name" => "banane"]);
            $rechercheFruit->setFruit($fruit);
        }

        if ($request->get('genreId') != null) {
            $genre = $entityManager->getRepository(Genre::class)->find($request->get('genreId'));
            $rechercheFruit->setGenre($genre);
        }

        if ($request->get('formatId') != null) {
            $format = $entityManager->getRepository(Format::class)->find($request->get('formatId'));
            $rechercheFruit->setFormat($format);
        }

        if ($request->get('artisteId') != null) {
            $artiste = $entityManager->getRepository(Artiste::class)->find($request->get('artisteId'));
            $rechercheFruit->setArtiste($artiste);
        }
        if ($request->get('type') != null) {
            $rechercheFruit->setType($request->get('type'));
        }
        if ($request->get('year') != null) {
            $rechercheFruit->setYear($request->get('year'));
        }


        $fruitForm = $this->createForm(FruitFormType::class, $rechercheFruit);
        $fruitForm->handleRequest($request);
        if ($fruitForm->isSubmitted() && $fruitForm->isValid()) {
            $fruit = $rechercheFruit->getFruit();

            $genreId = !empty($rechercheFruit->getGenre()) ? $rechercheFruit->getGenre()->getId() : "";
            $formatId = !empty($rechercheFruit->getFormat()) ? $rechercheFruit->getFormat()->getId() : "";
            $artisteId = !empty($rechercheFruit->getArtiste()) ? $rechercheFruit->getArtiste()->getId() : "";

            return $this->redirectToRoute('app_search', ['fruitId' => $fruit->getId(),
                'genreId' => $genreId, 'artisteId' => $artisteId, 'type' => $rechercheFruit->getType(),
                'year' => $rechercheFruit->getYear(), 'formatId' => $formatId]);
        }

        $genreName = isset($genre) ? $genre->getName() : "";
        $artisteName = isset($artiste) ? $artiste->getName() : "";
        $formatName = isset($format) ? $format->getName() : "";
        $response = $apiDiscogsService->queryAll($fruit->getName(), $genreName, $artisteName, $rechercheFruit->getType(),
            $rechercheFruit->getYear(), $formatName);

        try {
            if ($response->getStatusCode() != 200) {
                return [];
            }
            $reponses = $response->toArray()["results"];
            $pagination = $response->toArray()["pagination"];
            $results = [];
            foreach ($reponses as $reponse) {
                $reponseUniform = array();
                $reponseUniform["id"] = $reponse["id"];
                $reponseUniform["title"] = $reponse["title"];
                $reponseUniform["coverImage"] = $reponse["thumb"];

                $reponseUniform["genres"] = isset($reponse["genre"]) ? $reponse["genre"] : "";
                $formats = isset($reponse["format"]) ? $reponse["format"] : array();
                if ($reponse["type"] != "artist") {
                    for ($i = 0; $i < count($formats); ++$i) {
                        $formats[$i] = str_replace('"', '', $formats[$i]);
                    }
                }
                $reponseUniform["formatsArray"] = $formats;
                $reponseUniform["formats"] = json_encode($formats);
                $reponseUniform["type"] = isset($reponse["type"]) ? $reponse["type"] : "";
                $reponseUniform["year"] = isset($reponse["year"]) ? $reponse["year"] : "";
                $reponseUniform["label"] = isset($reponse["label"]) ? $reponse["label"][0] : "";
                $results[] = $reponseUniform;
            }

            return $this->render('home/liste_search.html.twig', [
                'controller_name' => 'HomeController', 'results' => $results, 'fruit' => $fruit->getName(), 'entity' => 'artist',
                'fruitForm' => $fruitForm->createView(), 'page' => $pagination['page'], 'pages' => $pagination['pages']// Passez la page en param

            ]);
        } catch (ExceptionInterface $e) {
            return [];
        }
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    #[Route('/searchPagi', name: 'app_search_pagi')]
    public function searchPagi(\Symfony\Component\HttpFoundation\Request $request, EntityManagerInterface $entityManager, ApiDiscogsService $apiDiscogsService, string $S_type = 'master'): JsonResponse
    {
        $rechercheFruit = new RechercheFruit();
        if ($request->get('fruitId') != null) {
            $fruit = $entityManager->getRepository(Fruit::class)->find($request->get('fruitId'));
            $fruitName = $fruit->getName();
        }

        if ($request->get('genreId') != null) {
            $genre = $entityManager->getRepository(Genre::class)->find($request->get('genreId'));
            $genreName = $genre->getName();
        } else {
            $genreName = "";
        }

        if ($request->get('formatId') != null) {
            $format = $entityManager->getRepository(Format::class)->find($request->get('formatId'));
            $formatName = $format->getName();

        } else {
            $formatName = "";
        }

        if ($request->get('artisteId') != null) {
            $artiste = $entityManager->getRepository(Artiste::class)->find($request->get('artisteId'));
            $artisteName = $artiste->getName();
        } else {
            $artisteName = "";
        }

        if ($request->get('type') != null) {
            $typeName = $request->get('type');
        }

        if ($request->get('year') != null) {
            $year = $request->get('year');
        } else {
            $year = "";
        }
        if ($request->get('page') != null) {
            $page = $request->get('page');
        } else {
            $page = "";
        }
        $fruitName = "banane";
        $typeName = "all";
        $response = $apiDiscogsService->queryAll($fruitName, $genreName, $artisteName, $typeName,
            $year, $formatName, $page);

        try {
            if ($response->getStatusCode() != 200) {
                return [];
            }
            $reponses = $response->toArray()["results"];
            $results = [];
            foreach ($reponses as $response) {
                if($response["type"] != "release") {
                    $reponseUniform = array();
                    $reponseUniform["id"] = $response["id"];
                    $reponseUniform["title"] = $response["title"];
                    $reponseUniform["coverImage"] = $response["thumb"];

                    $reponseUniform["genres"] = isset($response["genre"]) ? $response["genre"] : "";
                    $formats = isset($response["format"]) ? $response["format"] : array();
                    if ($response["type"] != "artist") {
                        for ($i = 0; $i < count($formats); ++$i) {
                            $formats[$i] = str_replace('"', '', $formats[$i]);
                        }
                    }
                    $reponseUniform["formatsArray"] = $formats;
                    $reponseUniform["formats"] = json_encode($formats);
                    $reponseUniform["type"] = isset($response["type"]) ? $response["type"] : "";
                    $reponseUniform["year"] = isset($response["year"]) ? $response["year"] : "";
                    $reponseUniform["label"] = isset($response["label"]) ? $response["label"][0] : "";
                    $results[] = $reponseUniform;
                }
            }


            return new JsonResponse($results);
        } catch (ExceptionInterface $e) {
            return "echec";
        }
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
//    #[Route('/searchMaster', name: 'app_search_master')]
//    public function searchAll(\Symfony\Component\HttpFoundation\Request $request, ApiDiscogsService $apiDiscogsService, string $S_type='master'): Response
//    {
//        $paginationForm = $this->createForm(PaginationFormType::class);
//        $paginationForm->handleRequest($request);
//        $I_page = isset($_GET['I_page']) ? $I_page = $_GET['I_page'] : 1;
//        if ($paginationForm->isSubmitted()) {
//            $data = $paginationForm->getData();
//
//            return $this->redirectToRoute('app_search', ['S_type' => $S_type,
//            'I_page' => $data['page']]);
//        }
//
//        $response = $apiDiscogsService->queryMaster('banane', $I_page);
//        try {
//            if ($response->getStatusCode() != 200)
//            {
//                return [];
//            }
//            $reponses = $response->toArray()["results"];
//            $results = [];
//            foreach ($reponses as $response) {
//                $reponseUniform = array();
//                $reponseUniform["id"] = $response["id"];
//                $reponseUniform["title"] = $response["title"];
//                $reponseUniform["coverImage"] = $response["cover_image"];
//
//                $reponseUniform["genres"] = isset($response["genre"]) ? $response["genre"] : "";
////                $reponseUniform["formats"] =
//                $formats =  isset($response["format"]) ? $response["format"] : "";
//                for($i=0;$i<count($formats); ++$i) {
//                    $formats[$i] = str_replace('"', '', $formats[$i]);
//                }
//                $reponseUniform["formats"] = json_encode($formats);
//                $reponseUniform["formatsArray"] = $formats;
//
//                $reponseUniform["type"] = isset($response["type"]) ? $response["type"] : "";
//                $reponseUniform["year"] = isset($response["year"]) ? $response["year"] : "";
//                $reponseUniform["label"] = isset($response["label"]) ? $response["label"][0] : "";
//                $results[] = $reponseUniform;
//            }
//            return $this->render('home/liste_search.html.twig', [
//                'controller_name' => 'HomeController', 'results' => $results, 'fruit'=>'banane', 'entity'=>'artist','paginationForm' => $paginationForm->createView(), // Passez le formulaire à Twig
//
//            ]);        } catch (ExceptionInterface $e) {
//            return [];
//        }
//    }
    #[Route('/like/unlike/artist', name: 'app_unlike_artist')]
    public function unlikeArtist(\Symfony\Component\HttpFoundation\Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true); // Récupérer les données JSON en tant que tableau associatif
        $entityManagerArtiste = $entityManager->getRepository(Artiste::class);
        $entityManagerUserArtiste = $entityManager->getRepository(UserArtiste::class);

        $id = !empty($requestData["id"]) ? $requestData["id"] : "";
        $artiste = $entityManagerArtiste->findOneBy(["discogsId" => $id]);
        $likedArtist = $entityManagerUserArtiste->findOneBy(["user" => $this->getUser(), "artiste" => $artiste]);
        if ($likedArtist != null) {
            $entityManager->remove($likedArtist);
        }
        $entityManager->flush();
        return new JsonResponse(['success' => true, 'id' => $id, 'action' => 'unlike']);
    }

    #[Route('/like/{action}/artist', name: 'app_like_artist')]
    public function likeArtist(\Symfony\Component\HttpFoundation\Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true); // Récupérer les données JSON en tant que tableau associatif
        $entityManagerArtiste = $entityManager->getRepository(Artiste::class);
        $entityManagerUserArtiste = $entityManager->getRepository(UserArtiste::class);
        $entityManagerFruit = $entityManager->getRepository(Fruit::class);
//        var_dump($requestData);
        $id = !empty($requestData["id"]) ? $requestData["id"] : "";
        $action = $requestData["action"];
        $name = !empty($requestData["name"]) ? $requestData["name"] : "";
        $artiste = $entityManagerArtiste->findOneBy(["discogsId" => $id]);
        if ($action == "unlike") {
            $likedArtist = $entityManagerUserArtiste->findOneBy(["user" => $this->getUser(), "artiste" => $artiste]);
            if ($likedArtist != null) {
                $entityManager->remove($likedArtist);
            }
        } else {
            $fruit = !empty($requestData["fruit"]) ? $requestData["fruit"] : "";
            if ($artiste == null) {
                $artiste = new Artiste();
                $artiste->setName($name);
                $artiste->setDiscogsId($id);
                $entityManager->persist($artiste);
                $artisteFruit = new ArtisteFruit();
                $artisteFruit->setArtiste($artiste);
                $artisteFruit->setFruit($entityManagerFruit->findOneBy(["name" => $fruit]));
                $entityManager->persist($artisteFruit);
            }

            $likedArtist = $entityManagerUserArtiste->findOneBy(["user" => $this->getUser(), "artiste" => $artiste]);
            if ($likedArtist == null) {
                $likedArtist = new UserArtiste();
                $likedArtist->setArtiste($artiste);
                $likedArtist->setUser($this->getUser());
                $entityManager->persist($likedArtist);
            }
        }
        $entityManager->flush();
        return new JsonResponse(['success' => true, 'id' => $id, 'action' => $action]);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    #[Route('/like/like/master', name: 'app_like_album')]
    public function likeAlbum(\Symfony\Component\HttpFoundation\Request $request, EntityManagerInterface $entityManager, ApiDiscogsService $apiDiscogsService): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true);
        $entityManagerAlbum = $entityManager->getRepository(Album::class);
        $entityManagerUserAlbum = $entityManager->getRepository(UserAlbum::class);
        $entityManagerFruit = $entityManager->getRepository(Fruit::class);
        $entityManagerAlbumFruit = $entityManager->getRepository(AlbumFruit::class);
        $entityManagerAlbumGenre = $entityManager->getRepository(AlbumGenre::class);
        $entityManagerAlbumFormat = $entityManager->getRepository(AlbumFormat::class);
        $id = !empty($requestData["id"]) ? $requestData["id"] : "";
        $fruit = !empty($requestData["fruit"]) ? $requestData["fruit"] : "";
        $fruit = $entityManagerFruit->findOneBy(["name" => $fruit]);
        $album = $entityManagerAlbum->findOneBy(["discogsId" => $id]);

        $response = $apiDiscogsService->queryGetMaster($id);
        try {
            $reponses = $response->toArray();
        } catch (ExceptionInterface $e) {
            return [];
        }

        if ($album == null) {
            $album = new Album();
            $album->setTitle($reponses["title"]);
            $album->setYear($reponses["year"]);
            $album->setDiscogsId($reponses["id"]);
            $entityManager->persist($album);

            foreach ($reponses["artists"] as $artist) {
                $newArtiste = new Artiste();
                $newArtiste->setName($artist["name"]);
                $newArtiste->setDiscogsId($artist["id"]);
                $entityManager->persist($newArtiste);
            }
            //ajouter albumArtiste
            foreach ($reponses["genres"] as $genre) {
                $newGenre = $entityManager->getRepository(Genre::class)->findOneBy(["name" => $genre]);
                if ($newGenre == null) {
                    $newGenre = new Genre();
                    $newGenre->setName($genre);
                    $entityManager->persist($newGenre);
                }
                if ($entityManagerAlbumGenre->findOneBy(["album" => $album, "genre" => $newGenre]) == null) {
                    $albumGenre = new AlbumGenre();
                    $albumGenre->setAlbum($album);
                    $albumGenre->setGenre($newGenre);
                    $entityManager->persist($albumGenre);
                }
            }
            if ($requestData["formats"] != null) {
                foreach (json_decode($requestData["formats"]) as $format) {
                    $newFormat = $entityManager->getRepository(Format::class)->findOneBy(["name" => $format]);
                    if ($newFormat == null) {
                        $newFormat = new Format();
                        $newFormat->setName($format);
                        $entityManager->persist($newFormat);
                    }
                    if ($entityManagerAlbumFormat->findOneBy(["album" => $album, "format" => $newFormat]) == null) {
                        $albumFormat = new AlbumFormat();
                        $albumFormat->setAlbum($album);
                        $albumFormat->setFormat($newFormat);
                        $entityManager->persist($albumFormat);
                    }
                }
            }
        }
        if ($fruit != null) {
            if ($entityManagerAlbumFruit->findOneBy(["album" => $album, "fruit" => $fruit]) == null) {
                $albumFruit = new AlbumFruit();
                $albumFruit->setAlbum($album);
                $albumFruit->setFruit($fruit);
                $entityManager->persist($albumFruit);
            }
        }

        $likedAlbum = $entityManagerUserAlbum->findOneBy(["user" => $this->getUser(), "album" => $album]);
        if ($likedAlbum == null) {
            $likedAlbum = new UserAlbum();
            $likedAlbum->setAlbum($album);
            $likedAlbum->setUser($this->getUser());
            $entityManager->persist($likedAlbum);
        }
        $entityManager->flush();
        return new JsonResponse(['success' => true, 'id' => $id, 'action' => "like"]);
    }

    #[Route('/like/unlike/master', name: 'app_unlike_album')]
    public function unlikeAlbum(\Symfony\Component\HttpFoundation\Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true); // Récupérer les données JSON en tant que tableau associatif
        $entityManagerAlbum = $entityManager->getRepository(Album::class);
        $entityManagerUserAlbum = $entityManager->getRepository(UserAlbum::class);
        $action = $requestData["action"];
        $id = !empty($requestData["id"]) ? $requestData["id"] : "";

        $album = $entityManagerAlbum->findOneBy(["discogsId" => $id]);

        if ($action == "unlike") {
            $likedAlbum = $entityManagerUserAlbum->findOneBy(["user" => $this->getUser(), "album" => $album]);
            if ($likedAlbum != null) {
                $entityManager->remove($likedAlbum);
            }
        }
        $entityManager->flush();
        return new JsonResponse(['success' => true, 'id' => $id, 'action' => $action]);
    }
}