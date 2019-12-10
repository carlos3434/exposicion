<?php

use Illuminate\Database\Seeder;
use App\Concepto;
class ConceptosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Concepto::create([
            'name'                  => 'INSCRIPCIONES',
            'unidad_medida'         => 'NIU',
            'codigo'                => '701001',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 1000.00,
            'tipo'                  => 0,
            'tipo_concepto_id'      => 1
        ]);
        Concepto::create([
            'name'                  => 'CUOTA ORDINARIA',
            'unidad_medida'         => 'NIU',
            'codigo'                => '701003',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 15,
            'tipo'                  => 0,
            'tipo_concepto_id'      => 1
        ]);
        Concepto::create([
            'name'                  => 'CERTIFICADOS VETERINARIOS',
            'unidad_medida'         => 'NIU',
            'codigo'                => '701005',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 0,
            'tipo_concepto_id'      => 1
        ]);
        Concepto::create([
            'name'                  => 'DUPLICADOS DE CARNET',
            'unidad_medida'         => 'NIU',
            'codigo'                => '701006',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 0,
            'tipo_concepto_id'      => 1
        ]);
        Concepto::create([
            'name'                  => 'EDUCAVET',
            'unidad_medida'         => 'NIU',
            'codigo'                => '701007',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 0,
            'tipo_concepto_id'      => 1
        ]);
        Concepto::create([
            'name'                  => 'PRE CONGRESOS',
            'unidad_medida'         => 'NIU',
            'codigo'                => '701008',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 0,
            'tipo_concepto_id'      => 1
        ]);
        Concepto::create([
            'name'                  => 'DUPLICADOS DE DIPLOMAS',
            'unidad_medida'         => 'NIU',
            'codigo'                => '701009',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 0,
            'tipo_concepto_id'      => 1
        ]);
        Concepto::create([
            'name'                  => 'LEGALIZACIONES Y NORMAS DEL CMV',
            'unidad_medida'         => 'NIU',
            'codigo'                => '701010',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 0,
            'tipo_concepto_id'      => 1
        ]);
        Concepto::create([
            'name'                  => 'MEDALLAS',
            'unidad_medida'         => 'NIU',
            'codigo'                => '701011',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 0,
            'tipo_concepto_id'      => 1
        ]);
        Concepto::create([
            'name'                  => 'DIVERSOS',
            'unidad_medida'         => 'NIU',
            'codigo'                => '701012',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 0,
            'tipo_concepto_id'      => 1
        ]);
        Concepto::create([
            'name'                  => 'SUELDOS',
            'unidad_medida'         => '',
            'codigo'                => '621101',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 2
        ]);
        Concepto::create([
            'name'                  => 'GRATIFICACIONES',
            'unidad_medida'         => '',
            'codigo'                => '621401',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 2
        ]);
        Concepto::create([
            'name'                  => 'REGIMEN DE PRESTACIONES DE SAL',
            'unidad_medida'         => '',
            'codigo'                => '627101',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 2
        ]);
        Concepto::create([
            'name'                  => 'COMPENSACION POR TIEMPO DE SERVICIO',
            'unidad_medida'         => '',
            'codigo'                => '629101',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 3
        ]);
        Concepto::create([
            'name'                  => 'TELEFONO',
            'unidad_medida'         => '',
            'codigo'                => '636401',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 4
        ]);
        Concepto::create([
            'name'                  => 'HONORARIOS ADMINISTRATIVOS',
            'unidad_medida'         => '',
            'codigo'                => '632111',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 4
        ]);
        Concepto::create([
            'name'                  => 'HONORARIOS ABOGADOS',
            'unidad_medida'         => '',
            'codigo'                => '632211',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 4
        ]);
        Concepto::create([
            'name'                  => 'HONORARIOS CONTADORES',
            'unidad_medida'         => '',
            'codigo'                => '632311',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 4
        ]);
        Concepto::create([
            'name'                  => 'CONSEJO DE DECANOS',
            'unidad_medida'         => '',
            'codigo'                => '632901',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 4
        ]);
        Concepto::create([
            'name'                  => 'ACTIVOS MENORES',
            'unidad_medida'         => '',
            'codigo'                => '632902',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 4
        ]);
        Concepto::create([
            'name'                  => 'MANTENIMIENTO MUEBLES Y ENSERE',
            'unidad_medida'         => '',
            'codigo'                => '634301',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 5
        ]);
        Concepto::create([
            'name'                  => 'CUOTA LOCAL ASOCIACION',
            'unidad_medida'         => '',
            'codigo'                => '634302',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 5
        ]);
        Concepto::create([
            'name'                  => 'AGUA',
            'unidad_medida'         => '',
            'codigo'                => '636301',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 6
        ]);
        Concepto::create([
            'name'                  => 'PASAJES TERRESTRES',
            'unidad_medida'         => '',
            'codigo'                => '631121',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 7
        ]);
        Concepto::create([
            'name'                  => 'PASAJES AEREOS',
            'unidad_medida'         => '',
            'codigo'                => '631122',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 7
        ]);
        Concepto::create([
            'name'                  => 'PLAYA ESTACIONAMIENTO',
            'unidad_medida'         => '',
            'codigo'                => '631123',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 7
        ]);
        Concepto::create([
            'name'                  => 'CORREOS',
            'unidad_medida'         => '',
            'codigo'                => '631221',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 7
        ]);
        Concepto::create([
            'name'                  => 'ALOJAMIENTO',
            'unidad_medida'         => '',
            'codigo'                => '631301',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 7
        ]);
        Concepto::create([
            'name'                  => 'VIATICOS POR VIAJE',
            'unidad_medida'         => '',
            'codigo'                => '631401',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 7
        ]);
        Concepto::create([
            'name'                  => 'PUBLICIDAD, PUBLICACIONES, REL',
            'unidad_medida'         => '',
            'codigo'                => '637101',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 7
        ]);
        Concepto::create([
            'name'                  => 'ATENCIONES GTOS REPRESENTACION',
            'unidad_medida'         => '',
            'codigo'                => '637102',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 7
        ]);
        Concepto::create([
            'name'                  => 'GASTOS INSTITUCIONALES',
            'unidad_medida'         => '',
            'codigo'                => '637301',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 7
        ]);
        Concepto::create([
            'name'                  => 'GASTOS BANCARIOS',
            'unidad_medida'         => '',
            'codigo'                => '639101',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 7
        ]);
        Concepto::create([
            'name'                  => 'CERTIFICADOS,CARNETS,DIPLOMAS',
            'unidad_medida'         => '',
            'codigo'                => '639201',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 7
        ]);
        Concepto::create([
            'name'                  => 'UTILES DE OFICINA',
            'unidad_medida'         => '',
            'codigo'                => '639202',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 7
        ]);
        Concepto::create([
            'name'                  => 'MOVILIDAD',
            'unidad_medida'         => '',
            'codigo'                => '639203',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 7,
        ]);
        Concepto::create([
            'name'                  => 'GASTOS LEGALES Y DE REGISTROS',
            'unidad_medida'         => '',
            'codigo'                => '639204',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 7
        ]);
        Concepto::create([
            'name'                  => 'MEDALLAS',
            'unidad_medida'         => '',
            'codigo'                => '639205',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 7
        ]);
        Concepto::create([
            'name'                  => 'UTILES DE ASEO Y LIMPIEZA',
            'unidad_medida'         => '',
            'codigo'                => '639208',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 7
        ]);
        Concepto::create([
            'name'                  => 'PANVET WORLD VETERINARY ASSOCI',
            'unidad_medida'         => '',
            'codigo'                => '653101',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 8
        ]);
        Concepto::create([
            'name'                  => 'OTROS GASTOS DIVERSOS',
            'unidad_medida'         => '',
            'codigo'                => '659901',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 8
        ]);
        Concepto::create([
            'name'                  => 'ITF',
            'unidad_medida'         => '',
            'codigo'                => '641201',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 1,
            'tipo_concepto_id'      => 9
        ]);
        Concepto::create([
            'name'                  => 'MULTAS',
            'unidad_medida'         => 'NIU',
            'codigo'                => '',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 0,
            'tipo_concepto_id'      => 10
        ]);
        Concepto::create([
            'name'                  => 'MULTAS POR ELECCIONES',
            'unidad_medida'         => 'NIU',
            'codigo'                => '',
            'codigo_sunat'          => '',
            'tipo_afecta_igv'       => '30',
            'precio'                => 0,
            'tipo'                  => 0,
            'tipo_concepto_id'      => 10
        ]);
    }
}
