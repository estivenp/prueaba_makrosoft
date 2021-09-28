<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contrato;
use App\Form\ContratoType;
use App\Service\ContratoServiceImpPHP7;

class ContratosController extends AbstractController
{
    private $contServ ;
    /**
     * @Route("/contratos", name="contratos")
     */
    public function index(): Response
    {
        return $this->render('contratos/index.html.twig', [
            'controller_name' => 'ContratosController',
        ]);
    }

    /**
     * @Route("/guardar_contrato", name="guardar_contrato")
     */
    public function guardarContrato(Request $request): Response
    {
        $contrato = new Contrato();
        $form = $this->createForm(ContratoType::class,$contrato);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $num_cont=$form->get('num_contrato')->getData();
            $fecha=$form->get('fecha_contrato')->getData()->format('Y-m-d H:i:s');
            $valor=$form->get('valor_total')->getData();
            $posts=$em->getRepository(Contrato::class)->guardar($num_cont,$fecha,$valor);
            $this->addFlash('exito','Se guardo con exito el contrato');
            return $this->redirectToRoute('guardar_contrato'); 
        }
        return $this->render('contratos/index.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/proyectar/{meses}/{servicio}", name="proyectar")
     */
    public function proyectar($meses,$servicio)
    {
        $codigoRetorno = Response::HTTP_OK;
        $em = $this->getDoctrine()->getManager();
        $contratos=$em->getRepository(Contrato::class)->obtenerContratos();
        $contServ = new ContratoServiceImpPHP7();
        $cuotas=$contServ->proyectar($meses,$servicio,$contratos);
        return $this->json($cuotas,$codigoRetorno);
        // return $this->json($contratos);
    }
}
