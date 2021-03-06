<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Llave;
use AppBundle\Form\Type\LlaveType;
use AppBundle\Repository\LlaveRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/llave")
 * @Security("is_granted('ROLE_USER')")
 */
class LlaveController extends Controller
{
    /**
     * @Route("/prestadas", name="llave_listar_prestadas")
     */
    public function listarPrestadasAction(LlaveRepository $llaveRepository)
    {
        $llaves = $llaveRepository->findPrestadas();

        return $this->render('llaves/listar_prestadas.html.twig', [
            'llaves' => $llaves
        ]);
    }

    /**
     * @Route("/listado", name="llave_listar")
     * @Security("is_granted('ROLE_SECRETARIO')")
     */
    public function listarAction(LlaveRepository $llaveRepository)
    {
        $llaves = $llaveRepository->findTodas();

        return $this->render('llaves/listar.html.twig', [
            'llaves' => $llaves
        ]);
    }

    /**
     * @Route("/{id}", name="llave_editar",
     *     requirements={"id":"\d+"})
     * @Security("is_granted('ROLE_SECRETARIO')")
     */
    public function formLlaveAction(Request $request, Llave $llave)
    {
        $form = $this->createForm(LlaveType::class, $llave);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->getDoctrine()->getManager()->flush();
                $this->addFlash('exito', 'Los cambios en la llave han sido guardados con éxito');
                return $this->redirectToRoute('llave_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Ha ocurrido un error al guardar los cambios');
            }
        }
        
        return $this->render('llaves/form.html.twig', [
            'form' => $form->createView(),
            'llave' => $llave,
            'es_nueva' => $llave->getId() === null
        ]);
    }

    /**
     * @Route("/nueva", name="llave_nueva")
     * @Security("is_granted('ROLE_SECRETARIO')")
     */
    public function formNuevaAction(Request $request)
    {
        $llave = new Llave();
        $llave
            ->setFechaPrestamo(new \DateTime());

        $this->getDoctrine()->getManager()->persist($llave);

        return $this->formLlaveAction($request, $llave);
    }

    /**
     * @Route("/eliminar/{id}", name="llave_eliminar")
     * @Security("is_granted('ROLE_SECRETARIO')")
     */
    public function eliminarAction(Request $request, Llave $llave)
    {

        if ($request->get('borrar') === '') {
            try {
                $this->getDoctrine()->getManager()->remove($llave);
                $this->getDoctrine()->getManager()->flush();
                $this->addFlash('exito', 'La llave ha sido borrada');
                return $this->redirectToRoute('llave_listar');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Ha ocurrido un error al guardar los cambios');
            }
        }

        return $this->render('llaves/eliminar.html.twig', [
            'llave' => $llave
        ]);
    }
}
