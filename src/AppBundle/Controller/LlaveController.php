<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Llave;
use AppBundle\Form\Type\LlaveType;
use AppBundle\Repository\LlaveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LlaveController extends Controller
{
    /**
     * @Route("/llave/prestadas", name="llave_listar_prestadas")
     */
    public function listarPrestadasAction(LlaveRepository $llaveRepository)
    {
        $llaves = $llaveRepository->findPrestadas();

        return $this->render('llaves/listar_prestadas.html.twig', [
            'llaves' => $llaves
        ]);
    }

    /**
     * @Route("/llave/{id}", name="llave_editar",
     *     requirements={"id":"\d+"})
     */
    public function formLlaveAction(Request $request, Llave $llave)
    {
        $form = $this->createForm(LlaveType::class, $llave);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                if ($request->get('borrar') === '') {
                    $this->getDoctrine()->getManager()->remove($llave);
                }
                $this->getDoctrine()->getManager()->flush();
                $this->addFlash('exito', 'Los cambios en la llave han sido guardados con éxito');
                return $this->redirectToRoute('llave_listar_prestadas');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Ha ocurrido un error al guardar los cambios');
            }
        }
        
        return $this->render('llaves/form.html.twig', [
            'form' => $form->createView(),
            'es_nueva' => $llave->getId() === null
        ]);
    }

    /**
     * @Route("/llave/nueva", name="llave_nueva")
     */
    public function formNuevaAction(Request $request)
    {
        $llave = new Llave();
        $llave
            ->setFechaPrestamo(new \DateTime());

        $this->getDoctrine()->getManager()->persist($llave);

        return $this->formLlaveAction($request, $llave);
    }
}
