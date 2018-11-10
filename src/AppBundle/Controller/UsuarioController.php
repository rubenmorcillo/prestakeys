<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends Controller
{
    /**
     * @Route("/usuario", name="usuario_listar")
     */
    public function usuarioListarAction()
    {
        $todosUsuarios = $this->getDoctrine()->getRepository('AppBundle:Usuario')->findAll();

        return $this->render('usuario/listar.html.twig', [
            'usuarios' => $todosUsuarios
        ]);
    }
}
