<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\ArticleColor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name')
            // ->add('poster')
            // ->add('altPicture1')
            // ->add('altPicture2')
            // ->add('altPicture3')
            ->add('posterUrl')
            ->add('posterFile', FileType::class)
            // ->add('altPicture1Url')
            // ->add('altPicture1File', FileType::class)
            // ->add('altPicture2Url')
            // ->add('altPicture2File', FileType::class)
            // ->add('altPicture2Url')
            // ->add('altPicture2File', FileType::class)
            ->add('price')
            ->add('reference')
            ->add('description')
            ->add('stock')
            ->add('matter')
            ->add('discount')
            ->add('categories', null, [
                'class' => Category::class,
                'choice_label' => 'name'
            ])
            ->add('brand', EntityType::class, [
                'class' => Brand::class,
                'choice_label' => 'name'
            ])
            ->add('articleColor', EntityType::class, [
                'class' => ArticleColor::class,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
