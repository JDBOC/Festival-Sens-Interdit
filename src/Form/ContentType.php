<?php

namespace App\Form;

use App\Entity\Content;
use App\Form\InSiFileType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titleFr')
            ->add('titleEn')
            ->add('contentFr', CKEditorType::class)
            ->add('contentEn', CKEditorType::class)
            ->add('cover', InSiFileType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
          'data_class' => Content::class,
        ]);
    }
}
