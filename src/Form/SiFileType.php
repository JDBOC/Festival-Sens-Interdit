<?php

namespace App\Form;

use App\Entity\SiFile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

/**
 * Form used in order to have a complete form
 */
class SiFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')

            ->add('type', ChoiceType::class, [
                'choices' => SiFile::FILE_TYPE
            ])
            ->add('mediaFile', VichFileType::class, [
                'required' => false,
                'download_uri' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SiFile::class,
        ]);
    }
}
