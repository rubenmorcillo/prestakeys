<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Dependencia;
use AppBundle\Form\Type\DependenciaType;
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
                return $this->redirectToRoute('portada');
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
