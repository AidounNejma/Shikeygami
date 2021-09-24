<?php

namespace App\Form;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;
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
            ->add('room')
            ->add('description', TypeTextType::class, [
                "label" => "Description complète du jeu",
                "required" => false,
                "constraints" => [
                    new NotBlank([
                        "message" => "Veuillez remplir la description"
                    ])
                ]
            ])
            ->add('synopsis', TypeTextType::class, [
                "label" => "Synopsis du jeu",
                "required" => false,
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
                'required' => false
            ])
            ->add('imageUrl2', FileType::class, [
                "mapped" => false,
                'required' => false
            ])
            ->add('imageUrl3', FileType::class, [
                "mapped" => false,
                'required' => false
            ])
            
            ->add('minPlayers', IntegerType::class, [
                'label' => 'Nombre de joueurs min',
                "required" => false,
                "constraints" => [
                    new GreaterThan(["value" => 1, "message" => "le nombre de joueur min doit etre superieur à 1"])
                ]
            ])
            ->add('maxPlayers', IntegerType::class, [
                'label' => 'Nombre de joueurs max',
                "required" => false,
                "constraints" => [
                    new GreaterThan(["value" => 1, "message" => "le nombre de joueur max doit etre superieur à 1"])
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
            ->add('gameDuration', NumberType::class, [
                'label' => 'Temps de jeu accordé',
                "required" => false,
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
