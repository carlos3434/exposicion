<?php

use Illuminate\Database\Seeder;
use App\Universidad;
class UniversidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Universidad::create([
            'name'          => 'Universidad Nacional Mayor de San Marcos - UNMSM',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional San Antonio Abad del Cusco - UNSAAC',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional de Trujillo - UNT',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional de San Agustín',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional de Ingeniería ',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional San Luis Gonzaga de Ica ',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional San Cristobal de Huamanga',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional del Centro del Perú',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional Agraria La Molina ',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional de La Amazonía Peruana',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional del Altiplano',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional de Piura',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional de Cajamarca',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional Pedro Ruiz Gallo',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional Federico Villarreal',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional Hermilio Valdizán',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional Agraria de la Selva',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional Daniel Alcides Carrión',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional de Educación Enrique Guzman y Valle',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional del Callao',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional José Faustino Sanchez Carrión',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional Jorge Basadre Grohmann',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional Santiago Antúnez de Mayolo',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional de San Martín',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional de Ucayali',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional de Tumbes',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional del Santa',
            'is_publica'    => true,
        ]);
        Universidad::create([
            'name'          => 'Universidad Nacional de Huancavelica',
            'is_publica'    => true,
        ]);


        Universidad::create([
            'name'          => 'P.U. Católica del Perú',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. Peruana Cayetano Heredia',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. Católica Santa María',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. del Pacífico',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. de Lima',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. de San Martín de Porres',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. Femenina del Sagrado Corazón',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. Inca Garcilaso de la Vega',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. de Piura',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. Ricardo Palma',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. Andina Néstor Cáceres Velásquez',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. Peruana los Andes',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. Peruana Unión',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. Andina del Cusco',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. de Huánuco',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. P. Tecnológica de los Andes',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. P. de Tacna',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. P. de Chiclayo',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. P. San Pedro',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. P. Antenor Orrego',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. P. Marcelino Champagnat',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. José Carlos Mariátegui',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. Científica del Perú',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. P. César Vallejo',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. P. del Norte',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. Peruana de Ciencias Aplicadas',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. Catolica los Ángeles de Chimbote',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. P. San Ignacio de Loyola',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. Alas Peruanas',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. P. Norbert Wienner',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. Católica San Pablo',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. P. San Juan Bautista',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. Tecnológica del Perú',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. Científica del Sur',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. Continental de Ciencia e Ingeniería',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. Católica Santo Toribio de Mogrovejo',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. P. Antonio Guillermo Urrelo',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. P. Señor de Sipán',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. Católica Sedes Sapientiae',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'Universidad ESAN',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'Facultad de Teología Pontificia y Civil de Lima',
            'is_publica'    => false,
        ]);
        Universidad::create([
            'name'          => 'U. Peruana de las Américas',
            'is_publica'    => false,
        ]);
    }
}
