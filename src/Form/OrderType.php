<?php

namespace App\Form;

use App\Entity\Calendar;
use App\Entity\Order;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\NotBlank;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateOfOrder', DateType::class, [
                'label' => 'Date de la commande',
                'widget' => 'single_text',
                'attr'=>[
                    'class' => 'orderDate'
                ]
            ])
            ->add('totalPrice', NumberType::class, [
                'label' => 'Prix total',
                'attr'=>[
                    'class' => 'orderTotalPrice'
                ]
            ])
            ->add('playerQuantity', IntegerType::class, [
                'label' => 'nombre de joueurs',
                "constraints" => [
                    new GreaterThan(["value" => 1, "message" => "2 joueurs minimum"]),
                    new LessThan(["value" => 11, "message" => "10 joueurs minimum"])
                ],
                'attr' => [
                    'min' => 2,
                    'max' => 10,
                    'placeholder' => 2,
                    'class' => 'orderPlayerQuantity'
                ],
            ])
            ->add('paymentStatus', ChoiceType::class, [
                'label' => 'Status du paiement',
                'choices' => [
                    'En cours' => 1,
                    'Paiement effectu??' => 2,
                    'R??servation annul??e' => 3
                ],
                'attr'=>[
                    'class' => 'orderPaymentStatus'
                ]
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => function(User $user){
                    return $user->getFirstName() . " - " . $user->getLastName() . " - " . $user->getUserIdentifier(); 
                },
                'placeholder' => 'Choisir un utilisateur',
                'attr'=>[
                    'class' => 'orderUser'
                ]
            ])
            ->add('calendar', EntityType::class, [
                'class' => Calendar::class,
                'choice_label' => 'id',
                'placeholder' => 'Choisir une session',
                'attr'=>[
                    'class' => 'orderCalendar'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
