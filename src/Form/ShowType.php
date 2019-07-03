<?php

  namespace App\Form;

use App\Entity\Content;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Form\InSiFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Edition;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ShowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('titleFr', TextType::class, ["label"=>"Titre"])
            ->add('contentFr', CKEditorType::class, ["label"=>"Contenu"])
            ->add('countryFr', TextType::class, ["label"=>"Pays"])
            ->add('titleEn', TextType::class, ["label"=>"Titre anglais"])
            ->add('contentEn', CKEditorType::class, ["label"=>"Contenu anglais"])
            ->add('countryEn', TextType::class, ["label"=>"Pays anglais"])
            ->add('duree', TextType::class, ["label"=>"Durée"])
            ->add('lieu', TextType::class, ["label"=>"Lieu"])
            ->add('date', TextType::class, ["label"=>"Date"])
            ->add('author', TextType::class, ["label"=>"Auteur"])
            ->add('director', TextType::class, ["label"=>"Directeur"])




            ->add('edition', EntityType::class, [
                'class' => Edition::class,
                'choice_label' => 'name',
            ])

            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        'data_class' => Content::class,
        ]);
    }
}
