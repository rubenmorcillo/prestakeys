<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\UsuarioType;
use AppBundle\Repository\UsuarioRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/datos", name="datos_personales")
     */
    public function datosPersonales(Request $request)
    {
        $usuario = $this->getUser();

        $form = $this->createForm(UsuarioType::class, $usuario, [
            'es_admin' => $this->isGranted('ROLE_SECRETARIO')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->getDoctrine()->getManager()->flush();
                $this->addFlash('exito', 'Datos personales guardados con éxito');
                return $this->redirectToRoute('portada');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Ha ocurrido un error al guardar los datos personales');
            }
        }

        return $this->render('usuario/personal.html.twig', [
            'form' => $form->createView(),
            'usuario' => $usuario
        ]);
    }
}
