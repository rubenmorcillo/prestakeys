<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Llave;
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
        // listar llaves que llevan más de X días sin devolver
        $fecha = new \DateTime();
        $dias = $this->getParameter('dias_de_retraso');
        $fecha->modify("-$dias dias");

        $llaves = $llaveRepository->findPrestadasAntesDeFecha($fecha);

        return $this->render('llaves/listar_prestadas_con_retraso.html.twig', [
            'llaves' => $llaves,
            'dias' => $dias
        ]);
    }

    /**
     * @Route("/llave/prestadas/con_retraso/notificar", name="llave_notificar_prestadas_con_retraso")
     */
    public function notificarPrestadasConRetrasoAction(LlaveRepository $llaveRepository, \Swift_Mailer $mailer)
    {
        // listar llaves que llevan más de X días sin devolver
        $fecha = new \DateTime();
        $dias = $this->getParameter('dias_de_retraso');
        $fecha->modify("-$dias dias");

        $llaves = $llaveRepository->findPrestadasAntesDeFecha($fecha);

        $texto = '';
        /** @var Llave $llave */
        foreach ($llaves as $llave) {
            $texto .= '* ' . $llave->getCodigo() . ' - ' . $llave->getDescripcion() . ' - ' . $llave->getUsuario()->getApellidos() . ', ' . $llave->getUsuario()->getNombre() . ' - ' . $llave->getFechaPrestamo()->format('d/m/Y') . "\n";
        }

        /** @var \Swift_Message $mensaje */
        $mensaje = $mailer->createMessage();
        $mensaje
            ->setFrom('prestakeys@iesoretania.es')
            ->setTo($this->getParameter('correo_notificacion'))
            ->setSubject("[prestakeys] Listado de llaves no devueltas en $dias días")
            ->setBody($texto);

        $mailer->send($mensaje);

        return $this->render('llaves/listar_prestadas_con_retraso.html.twig', [
            'llaves' => $llaves,
            'dias' => $dias
        ]);
    }
}
