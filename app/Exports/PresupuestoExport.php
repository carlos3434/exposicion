<?php

namespace App\Exports;

use App\Presupuesto;
use App\TipoConcepto;
use App\Pago;
use App\EstadoPago;
use DB;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;



use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

use Illuminate\Http\Request;
use App\Repositories\PresupuestoRepository;
use App\Repositories\ConceptoRepository;
//use App\Repositories\TipoPresupuestoRepository;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;

use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


//class PresupuestoExport implements FromCollection, WithStrictNullComparison, WithEvents
//class PresupuestoExport implements FromView, WithStrictNullComparison, WithEvents
class PresupuestoExport implements FromArray, WithEvents, WithColumnFormatting
{
    use Exportable;//, RegistersEventListeners;

    private $presupuestos;
    private $conceptos;
    private $request;

    private $mes = [
        '1' => 'ENE',
        '2' => 'FEB',
        '3' => 'MAR',
        '4' => 'ABR',
        '5' => 'MAY',
        '6' => 'JUN',
        '7' => 'JUL',
        '8' => 'AGO',
        '9' => 'SET',
        '10' => 'OCT',
        '11' => 'NOV',
        '12' => 'DIC',
    ];

    private $columna = [
        '1' => 'C',
        '2' => 'D',
        '3' => 'E',
        '4' => 'F',
        '5' => 'G',
        '6' => 'H',
        '7' => 'I',
        '8' => 'J',
        '9' => 'K',
        '10' => 'L',
        '11' => 'M',
        '12' => 'N',
    ];

    public function __construct(
        Request $request,
        PresupuestoRepository $presupuestos,
        ConceptoRepository $conceptos
        //TipoPresupuestoRepository $tipo_presupuesto

    )
    {
        $this->request = $request;
        $this->presupuestos = $presupuestos;
        $this->conceptos = $conceptos;
        //$this->tipo_presupuesto = $tipo_presupuesto;
    }
    public function view(): View
    {

        return view('exports.analytics', [
            'data' => $this->collection->toArray()
        ]);
    }
    public function array(): array
    {
        return [];
    }
    public function collection()
    {
        return $this->presupuestos->allForExcel($this->request);
    }

    public function description()
    {
        return 'Analytics Report';
    }

    private function getNameFromNumber($num) {
        $numeric = ($num - 1) % 26;
        $letter = chr(65 + $numeric);
        $num2 = intval(($num - 1) / 26);

        if ($num2 > 0) {
            return $this->getNameFromNumber($num2) . $letter;
        } else {
            return $letter;
        }
    }
    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER_00,
            'D' => NumberFormat::FORMAT_NUMBER_00,
            'E' => NumberFormat::FORMAT_NUMBER_00,
            'F' => NumberFormat::FORMAT_NUMBER_00,
            'G' => NumberFormat::FORMAT_NUMBER_00,
            'H' => NumberFormat::FORMAT_NUMBER_00,
            'I' => NumberFormat::FORMAT_NUMBER_00,
            'J' => NumberFormat::FORMAT_NUMBER_00,
            'K' => NumberFormat::FORMAT_NUMBER_00,
            'L' => NumberFormat::FORMAT_NUMBER_00,
            'M' => NumberFormat::FORMAT_NUMBER_00,
            'N' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }
    public function getMes($index)
    {
        return $this->mes[$index];
    }
    public function getColumnaMes($index)
    {
        return $this->columna[$index];
    }
    public function getMeses()
    {
        return $this->mes;
    }

    //public static function afterSheet(AfterSheet $event)
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $anio = $this->request->anio;
                if (!isset($anio)) {
                    $anio = '2019';
                }
                $event->sheet->getStyle('C5:O100')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
                //$objPHPExcel->getActiveSheet()->getStyle('B4')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);

                $event->sheet->getDefaultRowDimension()->setRowHeight(15);
                $event->sheet->getDefaultColumnDimension()->setWidth(12);
                $event->sheet->getColumnDimension('B')->setWidth(50);
                $event->sheet->getParent()->getDefaultStyle()->applyFromArray([
                    'font' => [
                        'name' => 'Calibri',
                        'size' => 8
                    ]
                ]);
                $i = 1;
                $event->sheet->getStyle("A$i:O$i")->getFont()->setSize(11)->setBold(true);
                $event->sheet->setCellValue('A'.$i, 'COLEGIO MEDICO VETERINARIO')->getStyle('A'.$i)->getFont()->setBold(true);
                $i++;
                $event->sheet->getStyle("A$i:O$i")->getFont()->setSize(10)->setBold(true);
                $event->sheet->getStyle("A$i:O$i")->getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);
                $event->sheet->setCellValue('A'.$i, 'PRESUPUESTO ANUAL CMVP');
                $event->sheet->mergeCells("A$i:O$i");

                $i++;
                foreach ($this->getMeses() as $key => $mes) {
                    $event->sheet->setCellValue($this->getColumnaMes($key).$i, $this->getMes($key) );
                }

                $event->sheet->setCellValue('O'.$i, 'TOTAL');
                $i++;
                $event->sheet->setCellValue('A'.$i, 'INGRESOS')->getStyle('A'.$i)->getFont()->setBold(true);

                $i++;
                //Ingresos
                foreach ($this->conceptos->getIngresos() as $concepto) {
                    $event->sheet->setCellValue('A'.$i, $concepto->codigo);
                    $event->sheet->setCellValue('B'.$i, $concepto->name);
                    //recorrer meses
                    foreach ($this->getMeses() as $key => $mes) {
                        //recorrer ingresos en BD
                        $monto = Pago::where('estado_pago_id', EstadoPago::COMPLETADA)
                        ->where(DB::raw('YEAR(created_at)'), $anio)
                        ->where(DB::raw('MONTH(created_at)'), $key )
                        ->where('concepto_id', $concepto->id)
                        ->sum(DB::raw('FORMAT(monto,2)'));
                        $event->sheet->setCellValue($this->getColumnaMes($key).$i, $monto );
                    }

                    $i++;
                }
                $event->sheet->setCellValue('B'.$i, 'TOTAL RUBRO INGRESOS')->getStyle('B'.$i)->getFont()->setBold(true);
                //totales por mes

                $i += 2;

                //Egresos
                $event->sheet->setCellValue('A'.$i, 'EGRESOS')->getStyle('A'.$i)->getFont()->setBold(true);
                $i++;
                $tipoConceptos = TipoConcepto::where('id','<>','1')->get();
                foreach ($tipoConceptos as $key => $tipoConcepto) {
                    $event->sheet->setCellValue('A'.$i, $tipoConcepto->name)->getStyle('A'.$i)->getFont()->setBold(true);
                    $i++;
                    foreach ($this->conceptos->getEgresosByTipo($tipoConcepto->id) as $key => $concepto) {
                        $event->sheet->setCellValue('A'.$i, $concepto->codigo);
                        $event->sheet->setCellValue('B'.$i, $concepto->name);

                        //recorrer meses
                        foreach ($this->getMeses() as $key => $mes) {
                            //recorrer ingresos en BD
                            $monto = Pago::where('estado_pago_id', EstadoPago::COMPLETADA)
                            ->where(DB::raw('YEAR(created_at)'), $anio)
                            ->where(DB::raw('MONTH(created_at)'), $key )
                            ->where('concepto_id', $concepto->id)
                            ->sum(DB::raw('FORMAT(monto,2)'));
                            $event->sheet->setCellValue($this->getColumnaMes($key).$i, $monto );
                        }

                        $i++;
                    }
                    $event->sheet->setCellValue('B'.$i, 'TOTAL RUBRO: ')->getStyle('B'.$i)->getFont()->setBold(true);
                    //totales por mes

                    $i+=2;
                }

                $event->sheet->setCellValue('B'.$i, 'TOTAL EGRESOS')->getStyle('B'.$i)->getFont()->setBold(true);
                $i += 2;
                $event->sheet->setCellValue('B'.$i, 'RESULTADO NETO')->getStyle('B'.$i)->getFont()->setBold(true);

            }
        ];
    }
}