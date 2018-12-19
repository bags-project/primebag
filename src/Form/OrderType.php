<?php

namespace App\Form;

use App\Entity\Order;
use App\Entity\OrderStatus;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('createdAt')
            // ->add('orderNumber')
            // ->add('paymentDate')
            // ->add('paymentReference')
            // ->add('sentAt')
            // ->add('shippingCost')
            // ->add('trackingNumber')
            // ->add('paymentMethod')
            // ->add('user')
            ->add('orderStatus', EntityType::class, [
                'class' => OrderStatus::class,
                'choice_label' => 'name'
            ])
            // ->add('carrier')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
