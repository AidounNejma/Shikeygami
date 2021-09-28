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
                ],
                "attr" => [
                    'class' => 'input-text'
                ],
                "label_attr" => [
                    'class' => 'bold'
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
                ],
                "attr" => [
                    'class' => 'input-choice'
                ],
                "label_attr" => [
                    'class' => 'bold'
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
                ],
                "attr" => [
                    'class' => 'input-textarea'
                ],
                "label_attr" => [
                    'class' => 'bold'
                ]
            ])
            ->add('synopsis', TextareaType::class, [
                "label" => "Synopsis du jeu",
                "required" => false,
                'attr' => [
                    'placeholder' => 'Synopsis du jeu',
                    'class' => 'synopsisArea'
                ],
                "constraints" => [
                    new NotBlank([
                        "message" => "Veuillez remplir le synopsis"
                    ])
                ],
                "label_attr" => [
                    'class' => 'bold'
                ]
            ])
            ->add('difficulty', ChoiceType::class, [
                'label' => 'Difficulté',
                'choices' => [
                    'Débutant' => 'Debutant',
                    'Intermédiaire' => 'Intermediaire',
                    'Expert' => 'Expert',
                ],
                "attr" => [
                    'class' => 'input-choice'
                ],
                "label_attr" => [
                    'class' => 'bold'
                ]
            ])
            ->add('imageUrl', FileType::class, [
                'label' => 'Illustration n°1',
                "mapped" => false,
                'required' => false,
                "attr" => [
                    'class' => 'input-file',
                    'accept' => "image/png, image/jpeg"
                ],
                "label_attr" => [
                    'class' => 'bold'
                ]
                // 'constraints' => [
                //     'maxSize' => '1M'
                // ]
            ])
            ->add('imageUrl2', FileType::class, [
                'label' => 'Illustration n°2',
                "mapped" => false,
                'required' => false,
                "attr" => [
                    'class' => 'input-file',
                    'accept' => "image/png, image/jpeg"
                ],
                "label_attr" => [
                    'class' => 'bold'
                ]
                // 'constraints' => [
                //     'maxSize' => '1M'
                // ]
            ])
            ->add('imageUrl3', FileType::class, [
                'label' => 'Illustration n°3',
                "mapped" => false,
                'required' => false,
                "attr" => [
                    'class' => 'input-file',
                    'accept' => "image/png, image/jpeg"
                ],
                "label_attr" => [
                    'class' => 'bold'
                ]
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
                    'class' => 'input-number'
                ],
                "label_attr" => [
                    'class' => 'bold'
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
                    'class' => 'input-number'
                ],
                "constraints" => [
                    new LessThan(["value" => 11, "message" => "Le nombre de joueurs maximum ne peut pas dépasser 10"])
                ],
                "label_attr" => [
                    'class' => 'bold'
                ]
            ])
            ->add('gameMaster', TypeTextType::class, [
                "label" => "Nom du maitre du jeu",
                "required" => false,
                "constraints" => [
                    new NotBlank([
                        "message" => "Indiquez le nom du maitre du jeu"
                    ])
                ],
                "attr" => [
                    'class' => 'input-text'
                ],
                "label_attr" => [
                    'class' => 'bold'
                ]
            ])
            ->add('gameDuration', IntegerType::class, [
                'label' => 'Temps de jeu accordé (en minutes)',
                "required" => false,
                'attr' => [
                    'min' => 30,
                    'placeholder' => 30,
                    'class' => 'input-number',
                ],

                "constraints" => [
                    new GreaterThan(["value" => 29, "message" => "La durée doit etre de 30 minutes minimum"])
                ],
                "label_attr" => [
                    'class' => 'bold'
                ]
            ])
            ->add('pricePerPerson', TypeTextType::class, [
                "label" => "Prix par personne",
                "required" => false,
                "attr" => [
                    'class' => 'input-text'
                ],
                "label_attr" => [
                    'class' => 'bold'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
