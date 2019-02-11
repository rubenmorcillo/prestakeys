<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Llave;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrestamoType extends AbstractType
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
                'choices' => $options['llaves'],
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'llaves' => []
        ]);
    }
}
