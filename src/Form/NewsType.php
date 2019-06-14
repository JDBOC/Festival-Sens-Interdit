<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Content;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title_fr',TextType::class,["label"=>"Titre"])
            //->add('contentType')
            // ->add('title_en')
            ->add('content_fr',TextType::class,["label"=>"Contenu"])
            // ->add('content_en')
            //->add('country_fr')
            // ->add('country_en')
            // ->add('complete')
            //->add('translated')
            // ->add('logos')
            // ->add('edition')
            // ->add('picture')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Content::class,
        ]);
    }
}
