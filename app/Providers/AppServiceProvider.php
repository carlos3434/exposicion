<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Resources\Json\Resource;

use App\Incidente;
use App\Translado;
use App\Licencia;
use App\ProcesoDisciplinario;
use App\Apelacion;
use App\Comite;
use App\ResultadoEleccion;
use App\ListaGanadora;
use App\ListaPostulante;
use App\Persona;
use Caffeinated\Shinobi\Models\Role;
use App\Cliente;
use App\Empresa;
use App\Invoice;
use App\TipoDocumentoPago;
use App\TipoDocumentoIdentidad;
use App\Beneficiario;
use App\Gasto;

use App\Observers\IncidenteObserver;
use App\Observers\TransladoObserver;
use App\Observers\LicenciaObserver;
use App\Observers\ProcesoDisciplinarioObserver;
use App\Observers\ApelacionObserver;
use App\Observers\ComiteObserver;
use App\Observers\ResultadoEleccionObserver;
use App\Observers\ListaGanadoraObserver;
use App\Observers\ListaPostulanteObserver;
use App\Observers\PersonaObserver;
use App\Observers\RoleObserver;
use App\Observers\ClienteObserver;
use App\Observers\EmpresaObserver;
use App\Observers\InvoiceObserver;
use App\Observers\BeneficiarioObserver;
use App\Observers\GastoObserver;

use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Incidente::observe(IncidenteObserver::class);
        Translado::observe(TransladoObserver::class);
        Licencia::observe(LicenciaObserver::class);
        ProcesoDisciplinario::observe(ProcesoDisciplinarioObserver::class);
        Apelacion::observe(ApelacionObserver::class);
        Comite::observe(ComiteObserver::class);
        ResultadoEleccion::observe(ResultadoEleccionObserver::class);
        ListaGanadora::observe(ListaGanadoraObserver::class);
        ListaPostulante::observe(ListaPostulanteObserver::class);
        Persona::observe(PersonaObserver::class);
        Role::observe(RoleObserver::class);
        Cliente::observe(ClienteObserver::class);
        Empresa::observe(EmpresaObserver::class);
        Invoice::observe(InvoiceObserver::class);
        Beneficiario::observe(BeneficiarioObserver::class);
        Gasto::observe(GastoObserver::class);

        Validator::extend('alpha_spaces', function ($attribute, $value) {
            return preg_match('/^[\pL\s]+$/u', $value); 
        });
        Validator::extend('alpha_num_spaces', function ($attribute, $value) {
            return preg_match('/^([-a-z0-9_0-9áéíóúüñÁÉÍÓÚÜÑ\, ])+$/i', $value);
        });
        Validator::extend('acentos', function ($attribute, $value) {
            return preg_match('/^[a-zA-Z0-9áéíóúüñÁÉÍÓÚÜÑ ]+$/', $value);
        });
        Validator::extend('tipo_documento_identidad', function ($attribute, $value) {
            if (request()->get('tipo_documento_pago_id') == TipoDocumentoPago::FACTURA && $value <> TipoDocumentoIdentidad::RUC ) {
                return false;
            }
            return true;
        });
        Validator::extend('numero_documento_identidad', function ($attribute, $value) {
            if ( request()->get('cliente')['tipo_documento_identidad_id'] == TipoDocumentoIdentidad::DNI && strlen($value) == 8 ) {
                return true;
            }
            if ( request()->get('cliente')['tipo_documento_identidad_id'] == TipoDocumentoIdentidad::RUC && strlen($value) == 11 ) {
                return true;
            }
            return false;
        });
        Schema::defaultStringLength(191);
        Resource::withoutWrapping();
    }
}
