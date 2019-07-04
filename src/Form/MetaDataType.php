<?php

namespace App\Form;

use App\Entity\MetaData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MetaDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, ['label' => false, 'attr' => ['placeholder' => 'Title']])
            ->add('description', null , ['label' => false, 'attr' => ['placeholder' => 'Description']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MetaData::class,
        ]);
    }
}
