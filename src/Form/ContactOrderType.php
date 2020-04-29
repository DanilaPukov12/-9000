<?php

namespace App\Form;

use App\Entity\ContactOrder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fio')
            ->add('date_order_at')
            ->add('created_at')
            ->add('mail')
            ->add('phone')
            ->add('number_people')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactOrder::class,
        ]);
    }
}
