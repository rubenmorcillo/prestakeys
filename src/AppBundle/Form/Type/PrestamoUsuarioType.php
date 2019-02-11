<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Llave;
use AppBundle\Entity\Usuario;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrestamoUsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('llave', EntityType::class, [
                'label' => 'Llave a prestar',
                'class' => Llave::class,
                'choice_label' => function(Llave $llave) {
                    return $llave->getCodigo() . ' - ' . $llave->getDescripcion() . ' - ' . $llave->getDependencia();
                },
                'choices' => [$options['llave']],
                'disabled' => true,
                'mapped' => false
            ])
            ->add('usuario', EntityType::class, [
                'label' => 'Usuario que recibe la llave',
                'class' => Usuario::class,
                'data' => $options['usuario']
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'llave' => null,
            'usuario' => null
        ]);
    }
}
