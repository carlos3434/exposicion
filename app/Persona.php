<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Filters\PersonaFilter;
use Illuminate\Database\Eloquent\Builder;

use App\Traits\SaveToUpper;

class Persona extends Model
{
    use SoftDeletes, SaveToUpper;
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'url_foto',
        'fecha_registro',
        'tipo_documento_identidad_id',
        'numero_documento_identidad',
        'nacionalidad_id',
        'apellido_paterno',
        'apellido_materno',
        'nombres',
        'ruc',
        'fecha_nacimiento',
        'estado_civil_id',
        'conyuge_apellido_paterno',
        'conyuge_apellido_materno',
        'conyuge_nombres',
        'numero_hijos',
        'departamento_id',
        'distrito_id',
        'provincia_id',
        'direccion',
        'telefono_fijo',
        'celular_uno',
        'celular_dos',
        'email_uno',
        'email_dos',
        'universidad_procedencia_id',
        'fecha_bachiller',
        'fecha_titulacion',
        'especialidad_posgrado_id',
        'area_ejercicio_profesional_id',
        'nombre_centro_laboral',
        'direccion_centro_laboral',
        'telefono_centro_laboral',
        'numero_cmvp',
        'fecha_aprobacion_consejo',
        'url_cv',
        'is_voluntario',
        'grupo_sanguineo',
        'departamento_colegiado_id',
        'is_habilitado',
        'is_juramentacion_programada',
        'is_juramentacion_validada',
        'is_licencia',
        'numero_incidencias',
        'numero_procesos_disciplinarios',
        'is_carnet',
        'is_inscripcion',
        'is_solicitud',
        'is_resuelve_consejo',
        'is_pago_colegiatura',
        'is_pago_cuota_mensual',
        'estado_registro_colegiado_id',
        'fecha_colegiatura',
        'fecha_resuelve_consejo',
        'estado_cuenta_sistema_id',
        'ultimo_mes_pago',
        'numero_meses_deuda',
        'total_deuda',
        'total_aportado',
        'total_faf',
        'total_adelanto',
        'total_departamental',
        'total_consejo',
        'numero_meses_adelanto',
        'numero_meses_aportado',
        'multa_pendiente',
        'multa_pagadas',
        'estado_solicitud',

        'numero_operacion',
        'banco_operacion',
        'fecha_operacion',
        'monto_operacion',
        
        'fecha_inscripcion',
        'fecha_presentacion_solicitud',
        'fecha_sesion',//fecha a evaluar la solicitud
        'fecha_llegada_solicitud',
        'fecha_registro_carnet',
        'fecha_emision_carnet',
        'fecha_juramentacion',
        'fecha_caducidad_carnet',
        'fecha_solicitud_faf',
        'fecha_recepcion_faf',
        'fecha_firma_consejo',
    ];
    //protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    public function scopeFilter(Builder $builder, $request)
    {
        return (new PersonaFilter($request))->filter($builder);
    }
    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable('personas');
    }
    protected $is_upper = [
        'apellido_paterno',
        'apellido_materno',
        'nombres',
        'conyuge_apellido_paterno',
        'conyuge_apellido_materno',
        'conyuge_nombres',
        'direccion',
        'nombre_centro_laboral',
        'direccion_centro_laboral',
        'banco_operacion',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->apellido_paterno} {$this->apellido_materno} {$this->nombres}";
    }
    /**
     * Get the TipoDocumentoIdentidad
     */
    public function tipoDocumentoIdentidad()
    {
        return $this->belongsTo('App\TipoDocumentoIdentidad');
    }
    /**
     * Get the Ubigeo
     */
    public function nacionalidad()
    {
        return $this->belongsTo('App\Ubigeo', 'nacionalidad_id');
    }
    /**
     * Get the EstadoCivil
     */
    public function estadoCivil()
    {
        return $this->belongsTo('App\EstadoCivil');
    }
    /**
     * Get the Ubigeo
     */
    public function departamento()
    {
        return $this->belongsTo('App\Ubigeo','departamento_id');
    }
    /**
     * Get the Ubigeo
     */
    public function distrito()
    {
        return $this->belongsTo('App\Ubigeo','distrito_id');
    }
    /**
     * Get the Ubigeo
     */
    public function provincia()
    {
        return $this->belongsTo('App\Ubigeo','provincia_id');
    }

    /**
     * Get the Universidad
     */
    public function universidadProcedencia()
    {
        return $this->belongsTo('App\Universidad','universidad_procedencia_id');
    }
    /**
     * Get the EspecialidadPosgrado
     */
    public function especialidadPosgrado()
    {
        return $this->belongsTo('App\EspecialidadPosgrado');
    }
    /**
     * Get the AreaEjercicioProfesional
     */
    public function areaEjercicioProfesional()
    {
        return $this->belongsTo('App\AreaEjercicioProfesional');
    }
    /**
     * Get the Ubigeo
     */
    public function departamentoColegiado()
    {
        return $this->belongsTo('App\Ubigeo','departamento_colegiado_id');
    }
    /**
     * Get the EstadoRegistroColegiado
     */
    public function estadoRegistroColegiado()
    {
        return $this->belongsTo('App\EstadoRegistroColegiado');
    }
    /**
     * Get the EstadoCuentaSistema
     */
    public function estadoCuentaSistema()
    {
        return $this->belongsTo('App\EstadoCuentaSistema');
    }
    /**
     * Get the PersonaInhabilitada
     */
    public function personaInhabilitada()
    {
            return $this->hasMany('App\PersonaInhabilitada');
    }
    public function pagos()
    {
        return $this->hasMany('App\Pago');
    }
}