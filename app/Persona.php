<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use SoftDeletes;
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
        'fecha_nacimiento',
        'estado_civil_id',
        'conyuge_apellido_paterno',
        'conyuge_apellido_materno',
        'conyuge_nombres',
        'numero_hijos',
        'ubigeo_id',
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
        'fecha_registro_consejo',
        'url_cv',
        'is_voluntario',
        'grupo_sanguineo',
        'departamento_colegiado_id',
        'is_habilitado',
        'is_incidencia',
        'is_carnet',
        'estado_registro_colegiado_id',
        'fecha_colegiatura',
        'fecha_aprovacion_consejo',
        'estado_cuenta_sistema_id',
        'ultimo_mes_pago',
        'numero_meses_deuda',
        'total_deuda',
        'total_aportado',
        'total_faf',
        'total_adelanto',
        'total_departamental',
        'total_consejo',
        'multa_pendiente',
        'multa_pagadas'
    ];
    //protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

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
}