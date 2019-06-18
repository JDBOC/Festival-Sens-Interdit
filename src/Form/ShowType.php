<?php

  namespace App\Form;

use App\Entity\Content;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Edition;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class ShowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titleFr')
            ->add('titleEn')
            ->add('contentFr', CKEditorType::class, array(
                    'config_name' => 'my_config',
                ))
            ->add('contentEn', CKEditorType::class)
            ->add('countryFr')
            ->add('countryEn')
            ->add('edition', EntityType::class, [
                'class' => Edition::class,
                'choice_label' => 'name',
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        'data_class' => Content::class,
        ]);
    }
}
