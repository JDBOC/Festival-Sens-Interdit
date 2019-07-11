<?php

namespace App\Form;

use App\Entity\Partner;
use App\Entity\SiFile;
use App\Form\InSiFileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Partner's form in admin view
 */
class PartnerType extends AbstractType
{
    /**
     * Create a Form
     * @param  FormBuilderInterface $builder
     * @param  array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('logo', InSiFileType::class, [
                'required'  => true,
            ])
            ->add('link');
    }

    /**
     * Configures the options of the form
     * @param  OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Partner::class,
        ]);
    }
}
