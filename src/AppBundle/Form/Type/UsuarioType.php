<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['es_admin']) {
            $builder
                ->add('nombreUsuario');
        }

        $builder
            ->add('nombre')
            ->add('apellidos');

        if ($options['es_admin']) {
            $builder
                ->add('ordenanza')
                ->add('secretario');
        }

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
            'es_admin' => false
        ]);
    }
}
