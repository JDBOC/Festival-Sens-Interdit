<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Content;
use App\Entity\Session;
use App\Entity\Edition;
use App\Form\InSiFileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titleFr', TextType::class, ["label"=>"Titre"])
            ->add('contentFr', CKEditorType::class, ["label"=>"Contenu", 'required' => false])
            ->add('countryFr', TextType::class, ["label"=>"Pays", 'required' => false])
            ->add('titleEn', TextType::class, ["label"=>"Titre anglais", 'required' => false])
            ->add('contentEn', CKEditorType::class, ["label"=>"Contenu anglais", 'required' => false])
            ->add('countryEn', TextType::class, ["label"=>"Pays", 'required' => false])
            ->add('cover', InSiFileType::class)
            ->add('thumbnail', InSiFileType::class)
            ->add('edition', EntityType::Class, ['class' => Edition::Class,    'choice_label' => 'name',])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Content::class,
        ]);
    }
}
