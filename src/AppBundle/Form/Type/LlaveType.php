<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Llave;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LlaveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codigo')
            ->add('descripcion')
            ->add('dependencia')
            ->add('prestatario')
            ->add('usuario')
            ->add('fechaPrestamo');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Llave::class
        ]);
    }
}
