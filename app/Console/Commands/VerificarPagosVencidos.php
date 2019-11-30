<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use DB;
use App\Persona;
use App\Pago;
use App\EstadoPago;

class VerificarPagosVencidos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verificar:pagosvencidos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Proceso que corre diariamente con el objetivo de identificar los pagos vencidos y generar inhabilitaciones a los colegiados';

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
        $dia_today = date("N", strtotime( $today )); // 1 al 5
        if (in_array($dia_today,[6,7])) {//si es sabado y domingo
            return;
        }
        $pagos = Pago::where('estado_pago_id', EstadoPago::PENDIENTE )
                ->select(
                    'pagos.*','p.is_habilitado','p.id as persona_id'
                )
                ->join('personas as p','pagos.persona_id', '=','p.id')
                ->where('pagos.fecha_vencimiento','<', $today )
                ->where('p.is_habilitado', 1 )
                ->get();
        $updates = 0 ;
        //var_dump($dia_today);
        foreach ($pagos as $key => $pago) {
            $dia_vencimiento = date("N", strtotime( $pago->fecha_vencimiento ));

            //inhabilitar
            $pago->persona->update(['is_habilitado'=>0]);
            //crear inicio de inhabilitacion
            $pago->persona->personaInhabilitada()->created([ 'fecha_inicio' => $today ]);
            $updates++;

        }

        Log::channel('verificar_pagos')->info('Actualizacion pagos vencidos, inhabilitando a '.$updates.' Colegiados');
    }
}
