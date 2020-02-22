<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 10/03/2019
 * Time: 21:45
 */

namespace Greenter\Data;

use Greenter\Model\Client\Client;
use Greenter\Model\Company\Address;
use Greenter\Model\Company\Company;

use DB;

class SharedStore
{
    public function getCompany($empresa)
    {
        $ubigeo = DB::table('ubigeos as dep')
        ->join('ubigeos as dis','dep.id', '=','dis.parent_id')
        ->join('ubigeos as prov','dis.id', '=','prov.parent_id')
        ->select(
            DB::raw('concat(dep.code , dis.code , prov.code ) as ubigeo'),
            'prov.id',
            'dep.name as departamento',
            'dis.name as distrito',
            'prov.name as provincia'
        )
        ->where('prov.id',$empresa->ubigeo_id) // 3967
        ->where('prov.level', 4)
        ->where('dis.level', 3)
        ->where('dep.level', 2)
        ->first();

        return (new Company())
            ->setRuc( $empresa->ruc )
            ->setNombreComercial( $empresa->nombre_comercial )
            ->setRazonSocial( $empresa->razon_social )
            ->setEmail( $empresa->email )
            ->setTelephone( $empresa->telefono )
            ->setAddress((new Address())
                ->setUbigueo( $ubigeo->ubigeo )
                ->setDistrito( $ubigeo->distrito )
                ->setProvincia( $ubigeo->provincia )
                ->setDepartamento( $ubigeo->departamento )
                //->setUrbanizacion('CASUARINAS')
                ->setCodLocal('0000')
                ->setDireccion( $empresa->direccion ));
    }

    public function getClient()
    {
        $client = new Client();
        $client->setTipoDoc('6')
            ->setNumDoc('20000000001')
            ->setRznSocial('EMPRESA 1 S.A.C.')
            ->setAddress((new Address())
                ->setDireccion('JR. NIQUEL MZA. F LOTE. 3 URB.  INDUSTRIAL INFANTAS - LIMA - LIMA -PERU'));

        return $client;
    }

    public function getClientPerson()
    {
        $client = new Client();
        $client->setTipoDoc('1')
            ->setNumDoc('48285071')
            ->setRznSocial('NIPAO GUVI')
            ->setAddress((new Address())
                ->setDireccion('Calle Geranios 453, SAN MIGUEL - LIMA - PERU'));

        return $client;
    }

    public function getSeller()
    {
        $client = new Client();
        $client->setTipoDoc('1')
            ->setNumDoc('44556677')
            ->setRznSocial('VENDEDOR 1')
            ->setAddress((new Address())
                ->setDireccion('AV INFINITE - LIMA - LIMA - PERU'));

        return $client;
    }
}