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
                'choice_label' => 'title',
                'placeholder' => 'Choisir un jeu'
            ])
            ->add('startTime', DateTimeType::class, [
                'label' => 'Heure de début',
                'widget' => 'single_text',
            ])
            ->add('endTime', DateTimeType::class, [
                'label' => 'Heure de fin',
                'widget' => 'single_text'
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
