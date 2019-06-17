<?php

namespace App\Form;

use App\Entity\SiFile;
use App\Entity\Content;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContentType extends AbstractType
{
  /**
   * @param FormBuilderInterface $builder
   * @param array $options
   */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title_fr')

            ->add('content_fr', CKEditorType::class)
            ->add('content_type')
            ->add('title_en')
            ->add('content_en', CKEditorType::class)
           // ->add('mediaFile', FileType::class, ['required' => false])
            ->add('complete', null, ['data'=>false])
            ->add('translated', null, ['data'=>false])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
          'data_class' => Content::class,
        ]);
    }
}
