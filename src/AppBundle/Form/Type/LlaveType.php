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
            ->add('codigo', null, [
                'label' => 'Código de la llave'
            ])
            ->add('descripcion', null, [
                'label' => 'Descripción'
            ])
            ->add('dependencia', null, [
                'label' => 'Dependencia'
            ])
            ->add('prestatario',  null, [
                'label' => '¿Quién la ha prestado?',
                'placeholder' => 'Nadie'
            ])
            ->add('usuario', null, [
                'label' => '¿Quién la tiene actualmente?',
                'placeholder' => 'Está en conserjería'
            ])
            ->add('fechaPrestamo', null, [
                'label' => 'Fecha del último préstamo',
                'widget' => 'single_text'
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Llave::class
        ]);
    }
}
