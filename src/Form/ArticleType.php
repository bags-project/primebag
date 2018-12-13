<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name')
            ->add('poster')
            ->add('altPicture1')
            ->add('altPicture2')
            ->add('altPicture3')
            ->add('price')
            ->add('reference')
            ->add('description')
            ->add('stock')
            ->add('matter')
            ->add('discount')
            ->add('categories')
            ->add('brand')
            ->add('articleColor')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
