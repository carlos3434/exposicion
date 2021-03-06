<?php
namespace App\Repositories;

use App\Persona;
use App\EstadoPago;
use DB;

use App\Repositories\Interfaces\DeudaRepositoryInterface;
/**
 * 
 */
class DeudaRepository implements DeudaRepositoryInterface
{
    public function allForExcel($request)
    {
        return Persona::select(
            'u.name as departamento',
            'p.monto',
            'p.name as concepto',
            'p.name as detalle',
            'p.fecha_vencimiento',
            'ep.name as estado',
            'personas.numero_documento_identidad as numeroDocumento',
            'personas.numero_cmvp as numeroColegiado',
            DB::raw("concat( personas.nombres,' ',personas.apellido_paterno , ' ', personas.apellido_materno ) as persona"),
            'p.created_at as fecha_generacion'
        )
        ->join('pagos as p','p.persona_id','=','personas.id')
        ->join('estado_pagos as ep','p.estado_pago_id','=','ep.id')
        ->join('conceptos as c','p.concepto_id','=','c.id')
        ->join('ubigeos as u','p.departamento_id','=','u.id')
        ->where('p.is_fraccion',0)
        //->where('p.estado_pago_id', EstadoPago::PENDIENTE)
        ->when($request->has('departamento_id'), function ($query) use ($request) {
            return $query->where('p.departamento_id', $request->departamento_id );
        })
        ->when($request->has('fecha_inicio'), function ($query) use ($request)  {
            return $query->where('p.fecha_vencimiento','>=', $request->fecha_inicio );
        })
        ->when($request->has('fecha_fin'), function ($query) use ($request)  {
            return $query->where('p.fecha_vencimiento','<=', $request->fecha_fin );
        })
        ->when($request->has('persona_id'), function ($query) use ($request)  {
            return $query->where('personas.id','=', $request->persona_id );
        })
        ;
    }
}