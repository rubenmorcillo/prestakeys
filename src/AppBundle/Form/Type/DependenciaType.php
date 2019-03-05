<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Dependencia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DependenciaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('responsables', null, [
                'disabled' => $options['secretario'] == false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dependencia::class,
            'secretario' => false
        ]);
    }
}
