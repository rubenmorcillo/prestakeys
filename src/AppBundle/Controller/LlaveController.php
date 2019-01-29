<?php

namespace AppBundle\Controller;

use AppBundle\Repository\LlaveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     * @Route("/llave/prestadas/con_retraso", name="llave_listar_prestadas_con_retraso")
     */
    public function listarPrestadasConRetrasoAction(LlaveRepository $llaveRepository)
    {
        // listar llaves que llevan más de 7 días sin devolver
        $fecha = new \DateTime();
        $dias = 7;
        $fecha->modify("-$dias dias");

        $llaves = $llaveRepository->findPrestadasAntesDeFecha($fecha);

        return $this->render('llaves/listar_prestadas_con_retraso.html.twig', [
            'llaves' => $llaves,
            'dias' => $dias
        ]);
    }
}
