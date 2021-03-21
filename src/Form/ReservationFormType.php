<?php

namespace App\Form;

use App\Entity\Reservation;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate',DateType::class,[
            'widget' => 'single_text'


            ])
            ->add('endDate',DateType::class,[
                'widget' => 'single_text'
            ])
            ->add('numberOfNights',IntegerType::class,
                [
                    'attr'=> [
                        'min'=>1,
                        'max'=>15,
                        'required'=>true
                    ]
                ])
            ->add('numberOfrooms',ChoiceType::class,
            [
                'choices'=> [
                    '1 room'=> 1,
                    '2 rooms'=> 2,
                    '3 rooms'=> 3,
                    '4 rooms'=> 4,
                    '5 rooms' => 5
                ]
            ])
            ->add('numberOfAdults',IntegerType::class,[
                'attr'=> [
                    'min'=>0,
                    'max'=>4,
                    'required'=>true
                ]
            ])
            ->add('numberOfChilds',IntegerType::class,[
                'attr'=> [
                    'min'=>0,
                    'max'=>3,
                    'required'=>true
                ]
            ])
            ->add('roomType',ChoiceType::class,[
                'choices' => [

                    'half pension'=> 'semi pension',
                    'full pension'=> 'pension complète',
                    'All Inclusive'=> 'all inclusive',
                    'All inclusive Soft Drink' => 'all inclusive soft drink'

                ],
                'placeholder'=>'choose an option'
            ])
            ->add('Book',SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
