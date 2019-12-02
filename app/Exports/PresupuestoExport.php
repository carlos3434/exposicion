<?php

namespace App\Exports;

use App\Presupuesto;
use App\TipoConcepto;

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



use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


//class PresupuestoExport implements FromCollection, WithStrictNullComparison, WithEvents
//class PresupuestoExport implements FromView, WithStrictNullComparison, WithEvents
class PresupuestoExport implements FromArray, WithStrictNullComparison, WithEvents
{
    use Exportable;//, RegistersEventListeners;

    private $presupuestos;
    private $conceptos;
    private $request;


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

    //public static function afterSheet(AfterSheet $event)
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                //$event->sheet->getDelegate()->getRowDimension(37)->setRowHeight(35);
                $event->sheet->getDefaultRowDimension()->setRowHeight(15);

                $event->sheet->getParent()->getDefaultStyle()->applyFromArray([
                    'font' => [
                        'name' => 'Calibri',
                        'size' => 8
                    ]
                ]);

                $event->sheet->getStyle('A1:O1')->getFont()->setSize(11)->setBold(true);
                $event->sheet->getStyle('A2:O2')->getFont()->setSize(10)->setBold(true);
                $event->sheet->getStyle('A2:O2')->getAlignment()->setHorizontal(Alignment::VERTICAL_CENTER);
                $event->sheet->setCellValue('A1', 'COLEGIO MEDICO VETERINARIO')->getStyle('A1')->getFont()->setBold(true);
                $event->sheet->setCellValue('A2', 'PRESUPUESTO ANUAL CMVP');
                $event->sheet->mergeCells('A2:O2');

                //$event->sheet->getRowDimension(1)->setRowHeight(20);
                //$event->sheet->getRowDimension(1)->setRowHeight(30);

                $event->sheet->getColumnDimension('B')->setWidth(50);

                $event->sheet->setCellValue('C4', 'ENE');
                $event->sheet->setCellValue('D4', 'FEB');
                $event->sheet->setCellValue('E4', 'MAR');
                $event->sheet->setCellValue('F4', 'ABR');
                $event->sheet->setCellValue('G4', 'MAY');
                $event->sheet->setCellValue('H4', 'JUN');
                $event->sheet->setCellValue('I4', 'JUL');
                $event->sheet->setCellValue('J4', 'AGO');
                $event->sheet->setCellValue('K4', 'SET');
                $event->sheet->setCellValue('L4', 'OCT');
                $event->sheet->setCellValue('M4', 'NOV');
                $event->sheet->setCellValue('N4', 'DIC');
                $event->sheet->setCellValue('O4', 'TOTAL');

                $event->sheet->setCellValue('A5', 'INGRESOS')->getStyle('A5')->getFont()->setBold(true);

                $i = 6;
                foreach ($this->conceptos->getIngresos() as $key => $concepto) {
                    $event->sheet->setCellValue('A'.$i, $concepto->codigo);
                    $event->sheet->setCellValue('B'.$i, $concepto->name);
                    $i++;
                }
                $event->sheet->setCellValue('B'.$i, 'TOTAL RUBRO INGRESOS')->getStyle('B'.$i)->getFont()->setBold(true);
                $i += 2;

                //Egresos
                $event->sheet->setCellValue('A'.$i, 'EGRESOS')->getStyle('A'.$i)->getFont()->setBold(true);
                $i++;
                //$this->tipo_presupuesto
                //recorrer tipos concepto
                $tipoConceptos = TipoConcepto::where('id','<>','1')->get();
                foreach ($tipoConceptos as $key => $tipoConcepto) {
                    $event->sheet->setCellValue('A'.$i, $tipoConcepto->name)->getStyle('A'.$i)->getFont()->setBold(true);
                    $i++;
                    //dentro de un tipo concepto preguntar que conceptos pertenecen 
                    foreach ($this->conceptos->getEgresosByTipo($tipoConcepto->id) as $key => $concepto) {
                        //tipo Cocnepto de pago
                        $event->sheet->setCellValue('A'.$i, $concepto->codigo);
                        $event->sheet->setCellValue('B'.$i, $concepto->name);
                        $i++;
                    }

                    $event->sheet->setCellValue('B'.$i, 'TOTAL RUBRO: ')->getStyle('B'.$i)->getFont()->setBold(true);
                    $i+=2;
                }
                
                $event->sheet->setCellValue('B'.$i, 'TOTAL EGRESOS')->getStyle('B'.$i)->getFont()->setBold(true);
                $i += 2;
                $event->sheet->setCellValue('B'.$i, 'RESULTADO NETO')->getStyle('B'.$i)->getFont()->setBold(true);

            }
        ];
    }
}