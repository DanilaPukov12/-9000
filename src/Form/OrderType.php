<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Ваше имя:",
                'attr' => [
                    'placeholder' => 'Имя*'
                ],
            ])
            ->add('address_from', TextType::class, [
                'label' => 'Откуда едем (адрес, место)',
                'attr' => [
                    'placeholder' => 'адрес, место'
                ],
                'required' => false
            ])
            ->add('address_at', TextType::class, [
                'label' => 'Куда едем (адрес, место)',
                'attr' => [
                    'placeholder' => 'адрес, место'
                ],
                'required' => false
            ])
            ->add('date', DateType::class, [
                'label' => 'Дата отправления:',
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('time_from', TimeType::class, [
                'label' => 'Врямя отправления:',
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('time_at', TimeType::class, [
                'label' => 'Время прибытия:',
                'widget' => 'single_text',
                'required' => false
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email:',
                'attr' => [
                    'placeholder' => 'Email*'
                ],
                'required' => false
            ])
            ->add('phone', TelType::class, [
                'label' => 'Телефон',
                'attr' => [
                    'placeholder' => '(555)-555-55-55'
                ],
                'required' => false
            ])
            ->add('number', IntegerType::class, [
                'label' => 'Кол-во человек:',
                'attr' => [
                    'placeholder' => '0'
                ],
                'required' => false
            ])
            ->add('is_confidentiality', CheckboxType::class, [
                'required' => false
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
