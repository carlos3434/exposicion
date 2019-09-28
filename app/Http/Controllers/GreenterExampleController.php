<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Greenter\Ws\Services\SunatEndpoints;
use Greenter\See;

use Greenter\Model\Client\Client;
use Greenter\Model\Company\Company;
use Greenter\Model\Company\Address;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Sale\Legend;
use App\Helpers\Util;


class GreenterExampleController extends Controller
{
    private $see;
    public function __construct()
    {
        $see = new See();
        $see->setService(SunatEndpoints::NUBEACT_BETA);
        
        //$see->setCertificate(file_get_contents(__DIR__.'/cmvp.pem'));
        $see->setCertificate(file_get_contents(base_path() . '/storage/cmvp.pem'));
        $see->setCredentials('20144793413MODDATOS'/*ruc+usuario*/, 'MODDATOS');
        $this->see = $see;
    }

    public function envio(){
        // Cliente
        $client = new Client();
        $client->setTipoDoc('6')
            ->setNumDoc('20000000001')
            ->setRznSocial('EMPRESA 1');

        // Emisor
        $address = new Address();
        $address->setUbigueo('150101')
            ->setDepartamento('LIMA')
            ->setProvincia('LIMA')
            ->setDistrito('LIMA')
            ->setUrbanizacion('NONE')
            ->setDireccion('AV LS');

        $company = new Company();
        $company->setRuc('20000000001')
            ->setRazonSocial('EMPRESA SAC')
            ->setNombreComercial('EMPRESA')
            ->setAddress($address);

        // Venta
        $invoice = (new Invoice())
            ->setUblVersion('2.1')
            ->setTipoOperacion('0101') // Catalog. 51
            ->setTipoDoc('01')
            ->setSerie('F001')
            ->setCorrelativo('1')
            ->setFechaEmision(new \DateTime())
            ->setTipoMoneda('PEN')
            ->setClient($client)
            ->setMtoOperGravadas(100.00)
            ->setMtoIGV(18.00)
            ->setTotalImpuestos(18.00)
            ->setValorVenta(100.00)
            ->setMtoImpVenta(118.00)
            ->setCompany($company);

        $item = (new SaleDetail())
            ->setCodProducto('P001')
            ->setUnidad('NIU')
            ->setCantidad(2)
            ->setDescripcion('PRODUCTO 1')
            ->setMtoBaseIgv(100)
            ->setPorcentajeIgv(18.00) // 18%
            ->setIgv(18.00)
            ->setTipAfeIgv('10')
            ->setTotalImpuestos(18.00)
            ->setMtoValorVenta(100.00)
            ->setMtoValorUnitario(50.00)
            ->setMtoPrecioUnitario(59.00);

        $legend = (new Legend())
            ->setCode('1000')
            ->setValue('SON DOSCIENTOS TREINTA Y SEIS CON 00/100 SOLES');

        $invoice->setDetails([$item])
                ->setLegends([$legend]);



        $result = $this->see->send($invoice);


        // Guardar XML
        file_put_contents($invoice->getName().'.xml',
                          $this->see->getFactory()->getLastXml());
        if (!$result->isSuccess()) {
            var_dump($result->getError());
            exit();
        }

        echo $result->getCdrResponse()->getDescription();
        // Guardar CDR
        file_put_contents('R-'.$invoice->getName().'.zip', $result->getCdrZip());

    }
    public function factura($numero){

        $util = Util::getInstance();
        // Cliente
        $client = new Client();
        $client->setTipoDoc('1')
            ->setNumDoc('20203030')
            ->setRznSocial('PERSON 1');
        // Venta
        $invoice = new Invoice();
        $invoice
            ->setUblVersion('2.1')
            ->setTipoOperacion('0101')
            ->setTipoDoc('03')
            ->setSerie('B001')
            ->setCorrelativo($numero)//'0003'
            ->setFechaEmision(new \DateTime())
            ->setTipoMoneda('PEN')
            ->setCompany($util->shared->getCompany())
            ->setClient($client)
            ->setMtoOperGravadas(100)
            ->setMtoIGV(18)
            ->setTotalImpuestos(18)
            ->setValorVenta(100)
            ->setMtoImpVenta(118)
            ;
        $item1 = new SaleDetail();
        $item1->setCodProducto('C023')
            ->setUnidad('NIU')
            ->setCantidad(2)
            ->setDescripcion('PROD 1')
            ->setMtoBaseIgv(100)
            ->setPorcentajeIgv(18)
            ->setIgv(18)
            ->setTipAfeIgv('10')
            ->setTotalImpuestos(18)
            ->setMtoValorVenta(100)
            ->setMtoValorUnitario(50)
            ->setMtoPrecioUnitario(59);
        $legend = new Legend();
        $legend->setCode('1000')
            ->setValue('SON CIENTO DIECIOCHO CON 00/100 SOLES');
        $invoice->setDetails([$item1])
            ->setLegends([$legend]);
        //write pdf
        try {
            $pdf = $util->getPdf($invoice);
            $util->writePdf( $invoice , $pdf );
        } catch (Exception $e) {
            var_dump($e);
        }
        // Envio a SUNAT.
        $see = $util->getSee(SunatEndpoints::NUBEACT_BETA);
        $res = $see->send($invoice);
        $util->writeXml($invoice, $see->getFactory()->getLastXml());
        if ($res->isSuccess()) {
            /**@var $res \Greenter\Model\Response\BillResult*/
            $cdr = $res->getCdrResponse();
            $util->writeCdr($invoice, $res->getCdrZip());
            $util->showResponse($invoice, $cdr);
        } else {
            echo $util->getErrorResponse($res->getError());
        }
    }
    public function boleta(){

    }
    public function nota(){

    }
    public function resumen(){

    }

}
