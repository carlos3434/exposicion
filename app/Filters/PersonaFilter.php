<?php

namespace App\Filters;

use App\Filters\AbstractFilter;

class PersonaFilter extends AbstractFilter
{
    protected $filters = [
        'full_name'                         => Persona\FullNameFilter::class,
        'nombres'                           => Persona\NombresFilter::class,
        'departamento_colegiado_id'         => Persona\DepartamentoColegiadoFilter::class, //nombre del campo en el request
        'tipo_documento_identidad_id'       => Persona\TipoDocumentoIdentidadFilter::class,
        'numero_documento_identidad'        => Persona\NumeroDocumentoIdentidadFilter::class,
        'nacionalidad_id'                   => Persona\NacionalidadFilter::class,
        'estado_civil_id'                   => Persona\EstadoCivilFilter::class,
        'departamento_id'                   => Persona\DepartamentoFilter::class,
        'distrito_id'                       => Persona\DistritoFilter::class,
        'provincia_id'                      => Persona\ProvinciaFilter::class,
        'universidad_procedencia_id'        => Persona\UniversidadProcedenciaFilter::class,
        'especialidad_posgrado_id'          => Persona\EspecialidadPosgradoFilter::class,
        'area_ejercicio_profesional_id'     => Persona\AreaEjercicioProfesionalFilter::class,
        'estado_registro_colegiado_id'      => Persona\EstadoRegistroColegiadoFilter::class,
        'estado_cuenta_sistema_id'          => Persona\EstadoCuentaSistemaFilter::class,
        'numero_cmvp'                       => Persona\NumeroCMVPFilter::class,
        'fecha_registro'                    => Common\FechaRegistroFilter::class,
    ];  
}