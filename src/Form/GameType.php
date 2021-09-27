<?php

namespace App\Form;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\NotBlank;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TypeTextType::class, [
                "label" => "Titre du jeu",
                "required" => false,
                "constraints" => [
                    new NotBlank([
                        "message" => "Le titre ne peut pas être vide"
                    ])
                ]
            ])
            ->add('room', ChoiceType::class, [
                'label' => "Numéro de la salle",
                'required' => false,
                'choices' => [
                    'Salle non attribuée' => NULL,
                    'Salle 01' => 1,
                    'Salle 02' => 2,
                    'Salle 03' => 3,
                    'Salle 04' => 4,
                ]
             ])
            ->add('description', TextareaType::class, [
                "label" => "Description complète du jeu",
                "required" => false,
                'attr' => [
                    'placeholder' => 'Description complète du jeu'
                ],
                "constraints" => [
                    new NotBlank([
                        "message" => "Veuillez remplir la description"
                    ])
                ]
            ])
            ->add('synopsis', TextareaType::class, [
                "label" => "Synopsis du jeu",
                "required" => false,
                'attr' => [
                    'placeholder' => 'Synopsis du jeu'
                ],
                "constraints" => [
                    new NotBlank([
                        "message" => "Veuillez remplir le synopsis"
                    ])
                ]
            ])
            ->add('difficulty', ChoiceType::class, [
                'label' => 'Difficulté',
                'choices' => [
                    'Débutant' => 'debutant',
                    'Intermédiaire' => 'intermediaire',
                    'Expert' => 'expert',
                ]
            ])
            ->add('imageUrl', FileType::class, [
                "mapped" => false,
                'required' => false,
                // 'constraints' => [
                //     'maxSize' => '1M'
                // ]
            ])
            ->add('imageUrl2', FileType::class, [
                "mapped" => false,
                'required' => false,
                // 'constraints' => [
                //     'maxSize' => '1M'
                // ]
            ])
            ->add('imageUrl3', FileType::class, [
                "mapped" => false,
                'required' => false,
                // 'constraints' => [
                //     'maxSize' => '1M'
                // ]
            ])
            
            ->add('minPlayers', IntegerType::class, [
                'label' => 'Nombre de joueurs min',
                "required" => false,
                'attr' => [
                    'min' => 2,
                    'max' => 10,
                    'placeholder' => 2,
                ],
                "constraints" => [
                    new GreaterThan(["value" => 1, "message" => "Créez un jeu pour minimum 2 joueurs"])
                ]
            ])
            ->add('maxPlayers', IntegerType::class, [
                'label' => 'Nombre de joueurs max',
                "required" => false,
                'attr' => [
                    'min' => 2,
                    'max' => 10,
                    'placeholder' => 2,
                ],
                "constraints" => [
                    new LessThan(["value" => 11, "message" => "Le nombre de joueurs maximum ne peut pas dépasser 10"])
                ]
            ])
            ->add('gameMaster', TypeTextType::class, [
                "label" => "Nom du maitre du jeu",
                "required" => false,
                "constraints" => [
                    new NotBlank([
                        "message" => "Indiquez le nom du maitre du jeu"
                    ])
                ]
            ])
            ->add('gameDuration', IntegerType::class, [
                'label' => 'Temps de jeu accordé (en minutes)',
                "required" => false,
                'attr' => [
                    'min' => 30,
                    'placeholder' => 30,
                ],
                "constraints" => [
                    new GreaterThan(["value" => 29, "message" => "La durée doit etre de 30 minutes minimum"])
                ]
            ])
            ->add('pricePerPerson', TypeTextType::class, [
                "label" => "Prix par personne",
                "required" => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
