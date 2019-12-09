<?php

use Illuminate\Database\Seeder;
use App\TipoDocumentoPago;
class TipoDocumentoPagoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoDocumentoPago::create([
            'codigo_sunat'  => '01',
            'name'          => 'Factura',
            'prefijo'       => 'F'
        ]);
        TipoDocumentoPago::create([
            'codigo_sunat'  => '03',
            'name'          => 'Boleta de Venta',
            'prefijo'       => 'B'
        ]);
        TipoDocumentoPago::create([
            'codigo_sunat'  => '07',
            'name'          => 'Nota de Credito'
        ]);
        TipoDocumentoPago::create([
            'codigo_sunat'  => '08',
            'name'          => 'Nota de Debito'
        ]);
        TipoDocumentoPago::create([
            'codigo_sunat'  => '09',
            'name'          => 'Guia de remision Remitente'
        ]);
        TipoDocumentoPago::create([
            'codigo_sunat'  => '12',
            'name'          => 'Ticket de maquina registradora'
        ]);
        TipoDocumentoPago::create([
            'codigo_sunat'  => '13',
            'name'          => 'Documento emitido por bancos'
        ]);
        TipoDocumentoPago::create([
            'codigo_sunat'  => '14',
            'name'          => 'Recibo servicios publicos'
        ]);
        TipoDocumentoPago::create([
            'codigo_sunat'  => '18',
            'name'          => 'Documento Emitido por las AFP'
        ]);
        TipoDocumentoPago::create([
            'codigo_sunat'  => '31',
            'name'          => 'Guia de remision Transportista'
        ]);
        TipoDocumentoPago::create([
            'codigo_sunat'  => '56',
            'name'          => 'Comprobante de pago SEAE'
        ]);
        TipoDocumentoPago::create([
            'codigo_sunat'  => '71',
            'name'          => 'Guia de remision remitente complementaria'
        ]);
        TipoDocumentoPago::create([
            'codigo_sunat'  => '72',
            'name'          => 'Guia de remision transportista complementaria'
        ]);
    }
}
