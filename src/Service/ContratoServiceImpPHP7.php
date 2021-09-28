<?php

namespace App\Service;

use App\Repository\ContratoRepository;
use Doctrine\Persistence\ManagerRegistry;

class ContratoServiceImpPHP7 implements ContratoServiceInterface
{
    

    public function __construct()
    {
    }

    /**
     * Esta funcion a partir de los meses y el servicio de pago, proyecta 
     * las cuotas para el numero de meses seleccionados y devuelve un array.
     * 
     * @param int $meses el numero de meses a proyectar
     * @param string $servicio indica el tipo de servicio por donde se realizara el pago,
     * puede se PayPal o PayOnline
     * @return array listado de cuotas
     */
    public function proyectar(int $meses,string $servicio,array $contratos): array
    {
        $cuotas=array();
        foreach($contratos as $contrato){
            $valor_cuota=$contrato['valor_total']/$meses;
            $fecha=$contrato['fecha_contrato'];
            for($i=0;$i<$meses;$i++){
                if(strtoupper($servicio)=="PAYPAL"){
                    $valor=$valor_cuota*1.01;
                    $valor=$valor+$valor_cuota*0.02;
                }
                else{ 
                    $valor=$valor_cuota*1.02;
                    $valor=$valor+$valor_cuota*0.01;
                }
                $nueva_fecha = strtotime('+1 month', strtotime($fecha));
                $nueva_fecha = date('d-m-Y', $nueva_fecha);
                $couta=array("numero_contrato"=>$contrato['num_contrato'],"fecha_contrato"=>$nueva_fecha,
                "valor_cuota"=>$valor);
                array_push($cuotas,$couta);
                $fecha=$nueva_fecha ;
            }
        }
        return $cuotas;
    }
}
