<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


use Illuminate\Http\Request;
use App\Repositories\DeudaRepository;

use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

class DeudasExport implements FromQuery, ShouldAutoSize, WithHeadings, WithStrictNullComparison
{
    use Exportable;

    private $request;
    private $deudas;

    public function __construct(
        Request $request,
        DeudaRepository $deudas
    )
    {
        $this->request = $request;
        $this->deudas = $deudas;
    }

    public function headings(): array
    {
        return [
            'departamento',
            'monto',
            'concepto',
            'detalle',
            'fecha_vencimiento',
            'estado',
            'numeroDocumento',
            'numeroColegiado',
            'persona',
            'fecha_generacion'
        ];
    }

    public function query()
    {
        return $this->deudas->allForExcel($this->request);
    }
}