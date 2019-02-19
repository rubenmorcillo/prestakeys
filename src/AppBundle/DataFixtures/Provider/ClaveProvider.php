<?php

namespace AppBundle\DataFixtures\Provider;


use AppBundle\Entity\Usuario;
use Faker\Generator;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class ClaveProvider
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function codificaClave($clave) {
        return $this->passwordEncoder->
            encodePassword(new Usuario(), $clave);
    }
}