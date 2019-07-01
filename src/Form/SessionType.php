<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Tarif;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sessionDate')
            ->add('location')
            ->add('tarifs', EntityType::Class, ['class' => Tarif::Class,
                    'choice_label' => 'grille', 'expanded' => true, 'multiple' => true, 'by_reference' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
