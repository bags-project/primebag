<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class UserRegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('address')
            ->add('secondaryAddress')
            ->add('phoneNumber')
            ->add('email')
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Votre mot de passe', 'label_attr' => [ 'class' => 'col-sm-2, control-label']),
                'second_options' => array('label' => 'Confirmer mot de passe'),
            ))
            ->add('zipCode')
            ->add('city', ChoiceType::class, array(
                'choices' => array(
                    'test' => 'test'
                )
            ))
            //->add('countryName')
            //->add('countryCode')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
