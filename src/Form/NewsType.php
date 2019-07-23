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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title_fr', TextType::class, ["label"=>"Titre", 'required' => true])
            ->add('content_fr', CKEditorType::class, ["label"=>"Contenu", 'required' => true])
            ->add('country_fr', TextType::class, ["label"=>"Pays", 'required' => false])
            ->add('title_en', TextType::class, ["label"=>"Titre anglais", 'required' => false])
            ->add('content_en', CKEditorType::class, ["label"=>"Contenu anglais", 'required' => false])
            ->add('country_en', TextType::class, ["label"=>"Pays", 'required' => false])
            ->add('thumbnail', InSiFileType::class, [ 'required' => false])
            ->add('cover', InSiFileType::class, [ 'required' => false])
            ->add('topArticle', CheckboxType::class, [
                'label'    => 'article dans le carousel',
                'required' => false,
            ])
            ->add('carouselPicture', InSiFileType::class, [ 'required' => false])
            ->add('thumbnail', InSiFileType::class, [ 'required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Content::class,
        ]);
    }
}
