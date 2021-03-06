<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,
            [
                'label' => 'Votre email *',
                'constraints' => [
                    new NotBlank([
                        'message' => "Merci d'entrer une adresse mail valide, cette dernière sera nécéssaire pour vous connecter",
                    ])
                    ]
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Choisir un mot de passe *',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe valide',
                    ]),
                    new Length([
                        'min' => 4,
                        'minMessage' => 'Votre mot de passe doit contenir un minimum de 4 caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 30,
                        'maxMessage' => 'Votre mot de passe doit contenir un maximum de 30 caractères'
                    ]),
                ],
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Votre prénom',
                'required' => false,
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Votre nom',
                'required' => false,
            ])
            ->add('userName', TextType::class, [
                'label' => 'Choisir un pseudo *',
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Vous certifiez avoir pris connaissance des conditions d\'utilisation de nos services **',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les conditions légales d\'utilisation de nos services',
                    ]),
                ],
                'required' => false,
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
