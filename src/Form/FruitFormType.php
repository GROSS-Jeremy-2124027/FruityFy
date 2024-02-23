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
                'required' => true,
                'attr' => [
                    'class' => 'form-control mb-2',
                ],
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'All' => 'all',
                    'Artist' => 'artist',
                    'Master' => 'master',
                ],
                'placeholder' => 'Sélectionnez un type de recherche',
                'required' => true,
                'attr' => [
                    'class' => 'form-control mb-2',
                ],
            ])
            ->add('genre', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => function ($genre) {
                    return $genre->getName();
                },
                'required' => false,
                'placeholder' => 'Sélectionnez un genre',
                'empty_data' => null,
                'attr' => [
                    'class' => 'form-control mb-2',
                ],
            ])
            ->add('format', EntityType::class, [
                'class' => Format::class,
                'choice_label' => function ($format) {
                    return $format->getName();
                },
                'required' => false,
                'placeholder' => 'Sélectionnez un format',
                'empty_data' => null,
                'attr' => [
                    'class' => 'form-control mb-2',
                ],
            ])
            ->add('artiste', EntityType::class, [
                'class' => Artiste::class,
                'choice_label' => function ($artiste) {
                    return $artiste->getName();
                },
                'required' => false,
                'placeholder' => 'Sélectionnez un artiste',
                'empty_data' => null,
                'attr' => [
                    'class' => 'form-control mb-2',
                ],
            ])
            ->add('year', IntegerType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control mb-2',
                    'placeholder' => 'Entrez une année',
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
