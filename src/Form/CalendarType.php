<?php

namespace App\Form;

use App\Entity\Calendar;
use App\Entity\Game;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('game', EntityType::class, [
                'class' => Game::class,
                'choice_label' => 'titre',
                'placeholder' => 'Choisir un jeu',
                'attr'=>[
                    'class' => 'game'
                ],
            ])
            ->add('startTime', DateTimeType::class, [
                'label' => 'Heure de début',
                'widget' => 'single_text',
                'attr'=>['class' => 'startTime']
            ])
            ->add('endTime', DateTimeType::class, [
                'label' => 'Heure de fin',
                'widget' => 'single_text',
                'attr'=>['class' => 'endTime']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
