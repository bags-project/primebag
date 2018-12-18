<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'required' => false,
                'label' => 'Prénom :',
                'attr' => [
                    'placeholder' => 'Prénom'
                ]
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom :',
                'attr' => [
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email :',
                'attr' => [
                    'placeholder' => 'exemple@email.fr'
                ]
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'Numéro de téléphone :',
                'attr' => [
                    'placeholder' => 'Numéro de téléphone'
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Votre message :',
                'attr' => [
                    'placeholder' => 'Pas de pub'
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
