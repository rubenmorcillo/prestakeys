<?php

namespace AppBundle\Security;


use AppBundle\Entity\Dependencia;
use AppBundle\Entity\Usuario;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class DependenciaVoter extends Voter
{
    const MODIFICAR = 'DEPENDENCIA_MODIFICAR';
    /**
     * @var AccessDecisionManagerInterface
     */
    private $accessDecisionManager;

    public function __construct(AccessDecisionManagerInterface $accessDecisionManager)
    {
        $this->accessDecisionManager = $accessDecisionManager;
    }

    /**
     * Determines if the attribute and subject are supported by this voter.
     *
     * @param string $attribute An attribute
     * @param mixed $subject The subject to secure, e.g. an object the user wants to access or any other PHP type
     *
     * @return bool True if the attribute and subject are supported, false otherwise
     */
    protected function supports($attribute, $subject)
    {
        if (false == $subject instanceof Dependencia) {
            return false;
        }

        if ($attribute != self::MODIFICAR) {
            return false;
        }

        return true;
    }

    /**
     * Perform a single access check operation on a given attribute, subject and token.
     * It is safe to assume that $attribute and $subject already passed the "supports()" method check.
     *
     * @param string $attribute
     * @param Dependencia $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        if (false == $subject instanceof Dependencia) {
            return false;
        }

        /** @var Usuario $usuario */
        $usuario = $token->getUser();

        switch($attribute) {
            case self::MODIFICAR:
                if ($this->accessDecisionManager->decide($token, ['ROLE_SECRETARIO'])) {
                    return true;
                }
                if ($subject->getResponsables()->contains($usuario)) {
                    return true;
                }

        }

        return false;
    }
}