<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

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
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
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
