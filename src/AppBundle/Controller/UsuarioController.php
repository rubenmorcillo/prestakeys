<?php

namespace AppBundle\Controller;

use AppBundle\Repository\UsuarioRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("is_granted('ROLE_USER')")
 */
class UsuarioController extends Controller
{
    /**
     * @Route("/usuario", name="usuario_listar")
     */
    public function usuarioListarAction(UsuarioRepository $usuarioRepository)
    {
        $todosUsuarios = $usuarioRepository->findAll();

        return $this->render('usuario/listar.html.twig', [
            'usuarios' => $todosUsuarios
        ]);
    }
}
