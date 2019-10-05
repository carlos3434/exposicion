<?php namespace App\Helpers;
use Greenter\Data\SharedStore;
use Greenter\Model\DocumentInterface;
use Greenter\Model\Response\CdrResponse;
use Greenter\Report\HtmlReport;
use Greenter\Report\PdfReport;
use Greenter\Report\Resolver\DefaultTemplateResolver;
use Greenter\See;

use Greenter\Model\Client\Client;
use Greenter\Model\Company\Company;
use Greenter\Model\Company\Address;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Sale\Legend;

use Illuminate\Support\Facades\Storage;
use File;


final class Util
{
    private static $current;
    /**
     * @var SharedStore
     */
    public $empresa;

    public static function getInstance()
    {
        if (!self::$current instanceof self) {
            self::$current = new self();
        }
        return self::$current;
    }
    public function setEmpresa($empresa){ //dd($empresa);
        $this->empresa = $empresa;
    }
    public function setCompany($empresa){
        $company = (new Company())
            ->setRuc( $empresa['ruc'] )
            ->setNombreComercial( $empresa['nombre_comercial'] )
            ->setRazonSocial( $empresa['razon_social'] )
            ->setEmail( $empresa['email'] )
            ->setTelephone( $empresa['telefono'] )
            ->setAddress((new Address())
                ->setUbigueo( $empresa['ubigeo'] )
                ->setDistrito( $empresa['distrito'] )
                ->setProvincia( $empresa['provincia'] )
                ->setDepartamento( $empresa['departamento'] )
                //->setUrbanizacion('CASUARINAS')
                ->setCodLocal('0000')
                ->setDireccion( $empresa['direccion'] ));
        return $company;
    }
    public function setClient($cliente){

        $client = new Client();
        $client->setTipoDoc( $cliente->tipoDocumentoIdentidad->codigo_sunat )
            ->setNumDoc( $cliente->numero_documento_identidad )
            ->setRznSocial( $cliente->razon_social )
            ->setEmail( $cliente->email )
            ->setTelephone( $cliente->telefono )
            ->setAddress((new Address())
                ->setDireccion( $cliente->direccion ));
        return $client;
    }
    public function setInvoice($comprobantePago , $company , $client ){

        $invoice = new Invoice();
        $invoice
            ->setUblVersion('2.1')
            ->setTipoOperacion( $comprobantePago->tipoOperacion->codigo_sunat )
            ->setTipoDoc( $comprobantePago->tipoDocumentoPago->codigo_sunat )
            ->setSerie( (($comprobantePago->tipoDocumentoPago->id==1)? 'F':'B'). $comprobantePago->serie->name)
            ->setCorrelativo( $comprobantePago->numero )//'0003'
            ->setFechaEmision(new \DateTime( $comprobantePago->fecha_emision ))
            //->setTipoMoneda( $comprobantePago->tipo_moneda ) //'PEN'
            ->setTipoMoneda( 'PEN' ) //'PEN'
            ->setCompany( $company )
            ->setClient( $client )
            ->setMtoOperGravadas( $comprobantePago->monto_gravada )
            ->setMtoOperInafectas( $comprobantePago->monto_inafecta )
            ->setMtoOperExoneradas( $comprobantePago->monto_exogerado )
            ->setMtoOperGratuitas( $comprobantePago->monto_gratuito )
            ->setMtoIGV( $comprobantePago->igv_total )
            ->setTotalImpuestos( $comprobantePago->igv_total )
            ->setValorVenta( $comprobantePago->monto_total )
            ->setMtoImpVenta( $comprobantePago->monto_total )
            ->setMtoDescuentos( $comprobantePago->descuento_total )//descuento_global
            ->setLegends( [
                (new Legend())
                    ->setCode('1000')
                    ->setValue( NumberLetter::convertToLetter( $comprobantePago->monto_total ) )
            ]);

        $detalles = [];
        foreach ($comprobantePago->invoiceDetail as $key => $invoiceDetail) {

            $item = new SaleDetail();
            $item->setCodProducto( $invoiceDetail->conceptoPago->codigo )
                ->setCodProdSunat( $invoiceDetail->conceptoPago->codigo_sunat )
                ->setUnidad( $invoiceDetail->conceptoPago->unidad_medida )
                ->setCantidad( $invoiceDetail->cantidad )
                ->setDescripcion( $invoiceDetail->descripcion )
                ->setMtoBaseIgv( $invoiceDetail->base_igv )
                ->setPorcentajeIgv(18)
                ->setIgv( $invoiceDetail->igv )
                ->setTipAfeIgv('10')/////////////////////////////////
                ->setTotalImpuestos( $invoiceDetail->igv )
                ->setMtoValorVenta( $invoiceDetail->valor_venta )
                ->setMtoValorUnitario( $invoiceDetail->valor_unitario )
                ->setMtoPrecioUnitario( $invoiceDetail->precio_unitario );

            if ($invoiceDetail->descuento_linea > 0) {
                /*$item->setDescuentos([(
                    new Charge())
                    ->setCodTipo('00')
                    ->setFactor( $invoiceDetail->factor )
                    ->setMonto( $invoiceDetail->montoDescuento )
                    ->setMontoBase( $invoiceDetail->montoBase )
                ]);*/
            }
            array_push($detalles, $item);

        }
        $invoice->setDetails($detalles);

        return $invoice;
    }

    /**
     * @param string $endpoint
     * @return See
     */
    public function getSee($endpoint)
    {
        $see = new See();
        $see->setService($endpoint);
        // Storage::get('public/'.$this->empresa->certificado_digital);
        //Storage::get('uploads/'.$this->empresa->certificado_digital);
        $see->setCertificate( Storage::get('uploads/'.$this->empresa->certificado_digital) );
        $see->setCredentials($this->empresa->user_sunat, $this->empresa->password_sunat );
        //$see->setCachePath(__DIR__ . '/../cache');
        $see->setCachePath(false);
        return $see;
    }
    public function showResponse(DocumentInterface $document, CdrResponse $cdr)
    {
        $filename = $document->getName();
        require base_path().'/resources/views/response.php';
    }
    public function getErrorResponse(\Greenter\Model\Response\Error $error)
    {
        $result = <<<HTML
        <h2 class="text-danger">Error:</h2><br>
        <b>Código:</b>{$error->getCode()}<br>
        <b>Descripción:</b>{$error->getMessage()}<br>
HTML;
        return $result;
    }
    public function writeXml(DocumentInterface $document, $xml)
    {
        $this->writeFile($document->getName().'.xml', $xml);
    }
    public function writeCdr(DocumentInterface $document, $zip)
    {
        $this->writeFile('R-'.$document->getName().'.zip', $zip);
    }
    public function writePdf(DocumentInterface $document, $pdf)
    {
        $this->writeFile($document->getName().'.pdf', $pdf);
    }
    public function writeFile($filename, $content)
    {
        if (getenv('GREENTER_NO_FILES')) {
            return;
        }
        $files_dir = 'uploads/files_sunat/';
        /*if ( !is_dir( $files_dir ) ) {
            mkdir( $files_dir , 0777, true );
        }*/
        Storage::put($files_dir.$filename, $content, 'public');
    }
    public function getPdf(DocumentInterface $document)
    {
        $cache_dir = base_path() . '/storage/cache_html';
        if ( !is_dir( $cache_dir ) ) {
            mkdir( $cache_dir , 0777, true );
        }

        $html = new HtmlReport('', [
            'cache' => $cache_dir,
            'strict_variables' => true,
        ]);
        $resolver = new DefaultTemplateResolver();
        $template = $resolver->getTemplate($document);
        $html->setTemplate($template);
        $render = new PdfReport($html);
        $tmpFolder = base_path() . '/storage/tmpJuan/';

        if ( !is_dir( $tmpFolder ) ) {
            mkdir( $tmpFolder , 0777, true );
        }
        $render->setOptions( [
            'tmpDir' => $tmpFolder,
            'no-outline',
            'print-media-type',
            'viewport-size' => '1280x1024',
            'page-width' => '21cm',
            'page-height' => '29.7cm',
            'footer-html' => base_path() . '/storage/footer.html',
        ]);
        $binPath = self::getPathBin();
        if (file_exists($binPath)) {
            $render->setBinPath($binPath);
        }
        $hash = $this->getHash($document);
        $params = $this->getParametersPdf();
        $params['system']['hash'] = $hash;
        $params['user']['footer'] = '<div>consulte en <a href="https://github.com/giansalex/sufel">sufel.com</a></div>';
        $pdf = $render->render($document, $params);
        if ($pdf === false) {
            $error = $render->getExporter()->getError();
            echo 'Error: '.$error;
            exit();
        }
        // Write html
        //$this->writeFile($document->getName().'.html', $render->getHtml());
        return $pdf;
    }
    public function getGenerator($type)
    {
        $factory = new \Greenter\Data\GeneratorFactory();
        $factory->shared = $this->shared;
        return $factory->create($type);
    }
    public static function generator($item, $count)
    {
        $items = [];
        for ($i = 0; $i < $count; $i++) {
            $items[] = $item;
        }
        return $items;
    }
    public function showPdf($content, $filename)
    {
        $this->writeFile($filename, $content);
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $filename . '"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . strlen($content));
        echo $content;
    }
    public static function getPathBin()
    {
        $path = __DIR__.'/../vendor/bin/wkhtmltopdf';
        //$path = __DIR__.'/../vendor/bin/wkhtmltopdf-amd64';
        if (self::isWindows()) {
            $path .= '.exe';
        }
        return $path;
    }
    public static function isWindows()
    {
        return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    }
    public static function inPath($command) {
        $whereIsCommand = self::isWindows() ? 'where' : 'which';
        $process = proc_open(
            "$whereIsCommand $command",
            array(
                0 => array("pipe", "r"), //STDIN
                1 => array("pipe", "w"), //STDOUT
                2 => array("pipe", "w"), //STDERR
            ),
            $pipes
        );
        if ($process !== false) {
            $stdout = stream_get_contents($pipes[1]);
            stream_get_contents($pipes[2]);
            fclose($pipes[1]);
            fclose($pipes[2]);
            proc_close($process);
            return $stdout != '';
        }
        return false;
    }
    private function getHash(DocumentInterface $document)
    {
        $see = $this->getSee('');
        $xml = $see->getXmlSigned($document);
        $hash = (new \Greenter\Report\XmlUtils())->getHashSign($xml);
        return $hash;
    }
    private function getParametersPdf()
    {
        //$logo = file_get_contents(base_path() . '/storage/logo_cmvp.png');
        $logo = Storage::get('uploads/'.$this->empresa->logo);
        return [
            'system' => [
                'logo' => $logo,
                'hash' => ''
            ],
            'user' => [
                'resolucion' => '212321',
                'header' => 'Telf: <b>(056) 123375</b>',
                'extras' => [
                    ['name' => 'CONDICION DE PAGO', 'value' => 'Efectivo'],
                    ['name' => 'VENDEDOR', 'value' => 'GITHUB SELLER'],
                ],
            ]
        ];
    }
}