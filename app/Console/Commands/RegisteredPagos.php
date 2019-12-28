<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use DB;
use App\Persona;
use App\Pago;
use App\Concepto;
use App\Helpers\MonthLetter;
use App\EstadoPago;

class RegisteredPagos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registered:pagos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'registra los pagos de los colegiados';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $today = date("Y-m-d");

        $cuota        = Concepto::find( Concepto::CUOTA );
        $cuotaSoloFAF = Concepto::find( Concepto::CUOTASOLOFAF );
        $fechaVencimientoCuota = date('Y-m-d', strtotime($today. '+ '.$cuota->plazo_dias.'days'));
        $fechaVencimientoCuota = date('Y-m-d', strtotime($fechaVencimientoCuota. '+ '.$cuota->plazo_meses.'months'));
        $fechaVencimientoCuotaSoloFAF = date('Y-m-d', strtotime($today. '+ '.$cuotaSoloFAF->plazo_dias.'days'));
        $fechaVencimientoCuotaSoloFAF = date('Y-m-d', strtotime($fechaVencimientoCuota. '+ '.$cuotaSoloFAF->plazo_meses.'months'));

        $mes_today = date("m", strtotime( $today ));
        $anio_today = date("Y", strtotime( $today ));

        //generar pagos a los colegiados que esten inscritos
        //insertar en la tabla pagos
        //fecha de vencimiento sera similar a la tabla plazos de conceptos
        $personas = Persona::where('is_licencia', 0)
        ->where('is_habilitado', 1)
        ->get();
        $creates = 0 ;
        foreach ($personas as $key => $persona) {

            $pagos = DB::table('pagos as p')
            ->where('mes_cuota',$mes_today )
            ->where('anio_cuota',$anio_today )
            ->whereIn('concepto_id', [Concepto::CUOTA,Concepto::CUOTASOLOFAF] )
            ->where('p.persona_id',$persona->id )
            ->count();
            if ($pagos==0) {
                $pago = [
                    'name' => $cuota->name .' '. MonthLetter::toLetter( (int) $mes_today ) .' ' . $anio_today,
                    'is_primera_cuota'   => 0,
                    'mes_cuota' =>  $mes_today ,
                    'anio_cuota' =>  $anio_today ,
                    'monto' => $cuota->precio,
                    'fecha_vencimiento' => $fechaVencimientoCuota,
                    'estado_pago_id' => EstadoPago::PENDIENTE,
                    'concepto_id' => $cuota->id,
                    'departamento_id' => $persona->departamento_colegiado_id
                ];
                $persona->pagos()->create($pago);
                $creates++;
            }

        }
        ///generar pagos de cuota para los que se encuentran de licencia, solo FAF
        $personas = Persona::where('is_licencia', 1)
        ->where('is_habilitado', 1)
        ->get();

        foreach ($personas as $key => $persona) {

            $pagos = DB::table('pagos as p')
            ->where('mes_cuota',$mes_today )
            ->where('anio_cuota',$anio_today )
            ->whereIn('concepto_id', [Concepto::CUOTA,Concepto::CUOTASOLOFAF] )
            ->where('p.persona_id',$persona->id )
            ->count();
            if ($pagos==0) {
                $pago = [
                    'name' => $cuotaSoloFAF->name .' solo FAF '. MonthLetter::toLetter( (int) $mes_today ) .' ' . $anio_today,
                    'is_primera_cuota'   => 0,
                    'mes_cuota' =>  $mes_today ,
                    'anio_cuota' =>  $anio_today ,
                    'monto' => $cuotaSoloFAF->precio,
                    'fecha_vencimiento' => $fechaVencimientoCuotaSoloFAF,
                    'estado_pago_id' => EstadoPago::PENDIENTE,
                    'concepto_id' => $cuotaSoloFAF->id,
                    'departamento_id' => $persona->departamento_colegiado_id
                ];
                $persona->pagos()->create($pago);
                $creates++;
            }
        }

        // consultar tabla personas inscritas. que noe sten conlicencias
        //recorrer la tabla y generar pagos egun fechas
        Log::channel('registrar_pagos')->info('Actualizacion de :'. $creates. "/".count($personas)." Personas.");
    }
}
