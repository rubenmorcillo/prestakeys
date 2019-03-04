<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Usuario;
use Faker\Generator;
use Faker\Provider\Base as BaseProvider;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class ClaveProvider extends BaseProvider
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    public function __construct(Generator $generator, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        parent::__construct($generator);
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function codificaClave($clave)
    {
        return $this->userPasswordEncoder->encodePassword(new Usuario(), $clave);
    }
}