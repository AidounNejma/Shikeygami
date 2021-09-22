<?php

namespace App\Form;

use App\Entity\Game;
use Doctrine\DBAL\Types\DecimalType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
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
                "required" => true,
                "constraints" => [
                    new NotBlank([
                        "message" => "le titre ne peut pas être vide"
                    ])
                ]
            ])
            ->add('room')
            ->add('description', TypeTextType::class, [
                "label" => "Description complète du jeu",
                "required" => true,
                "constraints" => [
                    new NotBlank([
                        "message" => "Veuillez remplir la description"
                    ])
                ]
            ])
            ->add('synopsis', TypeTextType::class, [
                "label" => "Synopsis du jeu",
                "required" => true,
                "constraints" => [
                    new NotBlank([
                        "message" => "Veuillez remplir le synopsis"
                    ])
                ]
            ])
            ->add('imageUrl', FileType::class, [
                "mapped" => false
            ])
            ->add('imageUrl2', FileType::class, [
                "mapped" => false
            ])
            ->add('imageUrl3', FileType::class, [
                "mapped" => false
            ])
            
            ->add('maxPlayers', IntegerType::class, [
                'label' => 'nombre de joueurs',
                "constraints" => [
                    new GreaterThan(["value" => 1, "message" => "le nombre de joueur max doit etre superieur à 1"])
                ]
            ])
            ->add('minPlayers', IntegerType::class, [
                'label' => 'nombre de joueurs',
                "constraints" => [
                    new GreaterThan(["value" => 1, "message" => "le nombre de joueur min doit etre superieur à 1"])
                ]
            ])
            ->add('gameMaster', TypeTextType::class, [
                "label" => "Nom du maitre du jeu",
                "required" => true,
                "constraints" => [
                    new NotBlank([
                        "message" => "Indiquez le nom du maitre du jeu"
                    ])
                ]
            ])
            ->add('gameDuration', NumberType::class, [
                'label' => 'Temps de jeu accordé',
                "constraints" => [
                    new GreaterThan(["value" => 30, "message" => "la durée doit etre de 30 minutes minimum"])
                ]
            ])
            ->add('pricePerPerson', TypeTextType::class, [
                "label" => "prix par personne",
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
