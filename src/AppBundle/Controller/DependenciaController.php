<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Dependencia;
use AppBundle\Form\Type\DependenciaType;
use AppBundle\Repository\DependenciaRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dependencia")
 * @Security("is_granted('ROLE_USER')")
 */
class DependenciaController extends Controller
{
    /**
     * @Route("/listado", name="dependencia_listar")
     * @Security("is_granted('ROLE_SECRETARIO')")
     */
    public function listarAction(DependenciaRepository $dependenciaRepository)
    {
        $dependencias = $dependenciaRepository->findTodas();

        return $this->render('dependencia/listar.html.twig', [
            'dependencias' => $dependencias
        ]);
    }

    /**
     * @Route("/{id}", name="dependencia_editar",
     *     requirements={"id":"\d+"})
     */
    public function formDependenciaAction(Request $request, Dependencia $dependencia)
    {
        $form = $this->createForm(DependenciaType::class, $dependencia, [
            'secretario' => $this->isGranted('ROLE_SECRETARIO')
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->getDoctrine()->getManager()->flush();
                $this->addFlash('exito', 'Los cambios en la dependencia han sido guardados con éxito');
                return $this->redirectToRoute('dependencia_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Ha ocurrido un error al guardar los cambios');
            }
        }
        
        return $this->render('dependencia/form.html.twig', [
            'form' => $form->createView(),
            'dependencia' => $dependencia
        ]);
    }
}
