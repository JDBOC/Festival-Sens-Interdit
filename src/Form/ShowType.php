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
use App\Entity\Session;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ShowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('edition', EntityType::Class, ['class' => Edition::Class,    'choice_label' => 'name',])
            // ->add('sessions', EntityType::Class, ['class' => Session::Class,    'choice_label' => 'location',])
            ->add('titleFr', TextType::class, ["label"=>"Titre", 'required' => true])
            ->add('contentFr', CKEditorType::class, ["label"=>"Contenu", 'required' => true])
            ->add('countryFr', TextType::class, ["label"=>"Pays", 'required' => true])
            ->add('titleEn', TextType::class, ["label"=>"Titre anglais", 'required' => false])
            ->add('contentEn', CKEditorType::class, ["label"=>"Contenu anglais", 'required' => false])
            ->add('countryEn', TextType::class, ["label"=>"Pays anglais", 'required' => false])
            ->add('cover', InSiFileType::class, ['required' => false])
            ->add('thumbnail', InSiFileType::class, [ 'required' => false])
            ->add('duree', TextType::class, ["label"=>"Durée", 'required' => false])
            ->add('lieu', TextType::class, ["label"=>"Lieu", 'required' => false])
            ->add('author', TextType::class, ["label"=>"Auteur", 'required' => false])
            ->add('director', TextType::class, ["label"=>"Directeur", 'required' => false])
            ->add('note', TextType::class, ["label"=>"A Noté", 'required' => false])



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
