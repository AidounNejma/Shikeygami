<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Order;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateOfOrder', DateType::class, [
                'label' => 'Date de la commande',
                'widget' => 'single_text',
            ])
            ->add('totalPrice', NumberType::class, [
                'label' => 'Prix total'
            ])
            ->add('bookedTime', DateTimeType::class, [
                'label' => 'Date et heure choisie',
                'widget' => 'single_text',
            ])
            ->add('paymentStatus', IntegerType::class, [
                'label' => 'Status du payement'
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => function(User $user){
                    return $user->getFirstName() . " - " . $user->getLastName() . " - " . $user->getUserIdentifier(); 
                },
                'placeholder' => 'Choisir un utilisateur',
                "mapped" => false
            ])
            ->add('game', EntityType::class,[
                "class" => Game::class,
                "choice_label" => function(Game $game){
                    return $game->getTitle();
                },
                "mapped" => false
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
