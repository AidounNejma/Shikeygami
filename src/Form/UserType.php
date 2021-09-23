<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['data'];
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [
                "label" => "Niveau d'autorisation",
                'choices' => [
                    "Simple Utilisateur" => "ROLE_USER",
                    "Administrateur" => "ROLE_ADMIN",
                    "Developpeur" => "ROLE_DEV"
                ],
                "multiple" => true,
                "expanded" => false,
                
            ])
            ->add('password', TextType::class, [
                'required' => $user->getId() ? false : true,
                'mapped' => false,
            ])
            ->add('dateOfCreation', DateType::class, [
                'label' => 'Date d\'inscription',
            ])
            ->add('username', TextType::class, [
                'label' => 'Pseudo'
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
                'required' => false
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
                'required' => false
            ])
            ->add('discountStatus', ChoiceType::class, [
                'label' => 'Réduction applicable',
                'choices' => [
                    'Aucune' => null,
                    '5%' => 1,
                    '10%' => 2,
                    '20%' => 3
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
