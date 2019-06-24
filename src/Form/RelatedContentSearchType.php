<?php

namespace App\Form;

use App\Entity\Content;
use App\Entity\RelatedContentSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * add som filtering options in order to select  related
 */
class RelatedContentSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contentType', ChoiceType::class, [
                'choices'=>Content::CONTENT_TYPE])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RelatedContentSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }
}
