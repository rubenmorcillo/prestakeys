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
            $this->getDoctrine()->getManager()->flush();
        }
        
        return $this->render('llaves/form.html.twig', [
            'form' => $form->createView()
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
