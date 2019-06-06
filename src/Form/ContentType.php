<?php

namespace App\Form;

use App\Entity\Content;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title_fr')
            ->add('contentType')
            ->add('status')
            ->add('title_en')
            ->add('content_fr')
            ->add('content_en')
            ->add('country_fr')
            ->add('country_en')
            ->add('mapadoLink')
            ->add('edition')
            ->add('logos')
            ->add('picture')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Content::class,
        ]);
    }
}
