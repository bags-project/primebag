<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

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
            ));

            //->add('countryName')
            //->add('countryCode')
        
        $builder->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event) {

                $form = $event->getForm();
                // var_dump($form);
    
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();
                // var_dump($data);
                
                // $city = $data->getCity();
                $city = $data['city'];
    
                $form->add('city', ChoiceType::class, array(
                    'choices' => [ $city => $city ]
                ));
    
            }
    );

}



    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
