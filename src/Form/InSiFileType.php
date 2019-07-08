<?php

namespace App\Form;

use App\Entity\SiFile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Form used in order to include sifile form without type
 */
class InSiFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('name')
            // ->add('type', ChoiceType::class, [
            //     'choices' => SiFile::FILE_TYPE
            // ])
            ->add('mediaFile', VichFileType::class, [
                'required' => false,
                'download_uri' => false,
                'allow_delete' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SiFile::class,
        ]);
    }
}
