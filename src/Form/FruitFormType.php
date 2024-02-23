<?php

namespace App\Form;
use App\Entity\Artiste;
use App\Entity\Format;
use App\Entity\Fruit;
use App\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FruitFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fruit', EntityType::class, [
                'class' => Fruit::class,
                'choice_label' => function ($fruit) {
                    return $fruit->getName();
                },
                'required' => true, // Champ non obligatoire
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'All' => 'all',
                    'Artist' => 'artist',
                    'Master' => 'master',
                ],
                'placeholder' => 'Sélectionnez un type de recherche', // Valeur vide par défaut
                'required' => true, // Rendre le champ obligatoire ou non selon vos besoins
            ])
            ->add('genre', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => function ($genre) {
                    return $genre->getName();
                },
                'required' => false, // Champ non obligatoire
                'placeholder' => 'Sélectionnez un genre', // Valeur vide par défaut
                'empty_data' => null, // Valeur vide par défaut
            ])
            ->add('format', EntityType::class, [
                'class' => Format::class,
                'choice_label' => function ($format) {
                    return $format->getName();
                },
                'required' => false, // Champ non obligatoire
                'placeholder' => 'Sélectionnez un format', // Valeur vide par défaut
                'empty_data' => null, // Valeur vide par défaut
            ])
            ->add('artiste', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => function ($artiste) {
                    return $artiste->getName();
                },
                'required' => false, // Champ non obligatoire
                'placeholder' => 'Sélectionnez un artiste', // Valeur vide par défaut
                'empty_data' => null, // Valeur vide par défaut
            ])
        ->add('year', IntegerType::class, [
        'required' => false, // Champ non obligatoire
        'attr' => [
            'placeholder' => 'Entrez une année', // Placeholder vide par défaut
        ],
    ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
