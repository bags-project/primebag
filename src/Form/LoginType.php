<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('firstName')
            // ->add('lastName')
            // ->add('address')
            // ->add('secondaryAddress')
            // ->add('phoneNumber')
            ->add('email')
            ->add('password')
            // ->add('city')
            // ->add('zipCode')
            // ->add('countryName')
            // ->add('countryCode')
            // ->add('roles')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
