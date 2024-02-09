<?php

namespace App\DataFixtures;

use App\Entity\Artiste;
use App\Entity\Format;
use App\Entity\Fruit;
use App\Entity\Genre;
use App\Entity\Label;
use App\Entity\Reference;
use App\Entity\ReferenceArtiste;
use App\Entity\ReferenceFormat;
use App\Entity\ReferenceFruit;
use App\Entity\ReferenceGenre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class FixtureTest extends Fixture
{
    public function load(EntityManagerInterface|ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $artiste = new Artiste();
        $artiste->setName("pnl");
        $manager->persist($artiste);

        $label = new Label();
        $label->setName("QLF Records");
        $manager->persist($label);

        $fruit = new Fruit();
        $fruit->setName("fraise");
        $manager->persist($fruit);

        $genre = new Genre();
        $genre->setName("cloud rap");
        $manager->persist($genre);

        $format = new Format();
        $format->setName("Album");
        $manager->persist($format);

        $reference = new Reference();
        $reference ->setTitle("deux freres")
            ->setYear(2019)
            ->setIdLabel($label);
        $manager->persist($reference);

        $referenceFruit = new ReferenceFruit();
        $referenceFruit->setFruit($fruit)
            ->setReference($reference);
        $manager->persist($referenceFruit);

        $referenceArtiste = new ReferenceArtiste();
        $referenceArtiste->setArtiste($artiste)
            ->setReference($reference);
        $manager->persist($referenceArtiste);

        $referenceGenre = new ReferenceGenre();
        $referenceGenre->setGenre($genre)
            ->setReference($reference);
        $manager->persist($referenceGenre);

        $referenceFormat = new ReferenceFormat();
        $referenceFormat->setFormat($format)
            ->setReference($reference);
        $manager->persist($referenceFormat);


        $manager->flush();
    }
}
