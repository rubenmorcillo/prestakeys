<?php

namespace AppBundle\Controller;

use AppBundle\Repository\LlaveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/llave/prestadas/json", name="llave_listar_prestadas")
     */
    public function listarPrestadasJsonAction(LlaveRepository $llaveRepository)
    {
        $llaves = $llaveRepository->findPrestadasArray();

        return new JsonResponse($llaves);
    }
}
