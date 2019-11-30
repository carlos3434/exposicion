<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use DB;
use App\ProcesoDisciplinario;
use App\Sancion;


class VerificarSuspencionColegiado extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verificar:suspencioncolegiados';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'verifica los colegiados que tengan fecha fin de suspencino hoy, y los habilita';

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
        $procesos = ProcesoDisciplinario::where('sancion_id',Sancion::SUSPENCION)
        ->where('is_apelacion', 0)
        ->where('fecha_fin', $today)
        ->get();

        $updates = 0 ;
        foreach ($procesos as $key => $proceso) {
            //habilitar colegiado
            $proceso->persona->update(['is_habilitado'=>true]);
            $updates++;
        }
        Log::channel('verificar_suspenciones')->info('Actualizacion de :'. $updates. " Personas.");
    }
}
