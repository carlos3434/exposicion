<?php

namespace App\Http\Resources\Inventario;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Responsable\ResponsableCollection;
class Inventario extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'id'                                    => $this->id,

            'departamento'                          => new DepartamentoCollection($this->departamento),
            'responsable'                           => new ResponsableCollection($this->responsable),
            'tipo_inventario'                       => new TipoInventarioCollection($this->tipoInventario),
            'estado_inventario'                     => new EstadoInventarioCollection($this->estadoInventario),

            'codigo'                                => $this->codigo,
            'descripcion'                           => $this->descripcion,
            'cantidad'                              => $this->cantidad,
            'marca'                                 => $this->marca,
            'modelo'                                => $this->modelo,
            'serie'                                 => $this->serie,
            'caracteristica'                        => $this->caracteristica,
            'ubicacion'                             => $this->ubicacion,
            'vida_util'                             => $this->vida_util,
            'valor_activo'                          => $this->valor_activo,

            'created_at'                            => $this->created_at->toDateTimeString(),

        ];
    }
}
