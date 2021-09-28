<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surname', TextType::class, [
                'label' => 'Nom de famille',
                'row_attr' => [
                    'id' => 'surname'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'row_attr' => [
                    'id' => 'lastName'
                ]
            ])
            ->add('telephone', NumberType::class, [
                'label' => 'Téléphone',
                'row_attr' => [
                    'id' => 'telephone',
                    'pattern' => '^[0-9]{10}$',
                    'maxlength' => '10'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'row_attr' => [
                    'id' => 'email'
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message',
                'row_attr' => [
                    'id' => 'message'
                ]
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            
        ]);
    }
}
