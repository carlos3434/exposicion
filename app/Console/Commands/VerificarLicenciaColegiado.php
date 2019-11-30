<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Licencia;

class VerificarLicenciaColegiado extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verificar:licenciacolegiados';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $licencias = Licencia::where('fecha_fin', $today)
        ->get();

        $updates = 0 ;
        foreach ($licencias as $key => $licencia) {
            //habilitar colegiado
            $licencia->persona->update(['is_licencia'=>false]);
            $updates++;
        }
        Log::channel('verificar_licencias')->info('Actualizacion de :'. $updates. " Personas.");
    }
}
