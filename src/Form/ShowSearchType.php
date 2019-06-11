<?php

namespace App\Form;

use App\Entity\ShowSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Edition;

/**
 * add som filtering options for show_index
 */
class ShowSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isComplete', CheckBoxType::class, [
                'label' => 'Incomplet',
                'required' => false])
            ->add('isTranslated', CheckBoxType::class, [
                'label' => 'Non traduit',
                'required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ShowSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }
}
