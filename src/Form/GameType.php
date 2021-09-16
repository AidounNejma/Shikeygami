<?php

namespace App\Form;

use App\Entity\Game;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TypeTextType::class, [
                "label" => "Titre de la salle",
                "required" => true,
                "constraints" => [
                    new NotBlank([
                        "message" => "le titre ne peut pas être vide"
                    ])
                ]
            ])
            ->add('room')
            ->add('description')
            ->add('imageUrl', FileType::class, [
                "mapped" => false
            ])
            ->add('maxPlayers')
            ->add('minPlayers')
            ->add('gameMaster')
            ->add('gameDuration')
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
