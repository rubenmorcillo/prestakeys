<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Llave;
use AppBundle\Entity\Usuario;
use AppBundle\Form\Type\PrestamoType;
use AppBundle\Form\Type\PrestamoUsuarioType;
use AppBundle\Repository\HistoriaRepository;
use AppBundle\Repository\LlaveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PrestamoController extends Controller
{
    /**
     * @Route("/llave/prestar", name="llave_prestar_listar", methods={"GET", "POST"})
     */
    public function prestarListarAction(Request $request, LlaveRepository $llaveRepository)
    {
        $llavesNoPrestadas = $llaveRepository->findNoPrestadas();

        $form = $this->createForm(PrestamoType::class, null, [
            'llaves' => $llavesNoPrestadas
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            /** @var Llave $llave */
            $llave = $data['llave'];
            return $this->redirectToRoute('llave_prestar', ['codigo' => $llave->getCodigo()]);
        }

        return $this->render('prestamo/listar_no_prestadas.html.twig', [
            'form' => $form->createView(),
            'llaves' => $llavesNoPrestadas
        ]);
    }

    /**
     * @Route("/llave/prestar/{codigo}/{prestar}", name="llave_prestar", methods={"GET", "POST"})
     */
    public function prestarAction(
        Request $request,
        HistoriaRepository $historiaRepository,
        Llave $llave,
        Usuario $prestar = null
    ) {
        $ultimasHistorias = $historiaRepository->findUltimosPorLlave($llave);

        $form = $this->createForm(PrestamoUsuarioType::class, null, [
            'llave' => $llave,
            'usuario' => $prestar
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $data = $form->getData();
                $llave
                    ->setUsuario($data['usuario'])
                    ->setFechaPrestamo(new \DateTime());

                $this->getDoctrine()->getManager()->flush();
                $this->addFlash('exito', 'Llave prestada con éxito');
                return $this->redirectToRoute('portada');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Ha ocurrido un error al prestar la llave');
            }
        }

        return $this->render('prestamo/listar_usuarios.html.twig', [
            'form' => $form->createView(),
            'llave' => $llave,
            'ultimas_historias' => $ultimasHistorias
        ]);
    }

}
