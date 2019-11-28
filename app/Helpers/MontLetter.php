<?php
namespace App\Helpers;

class MonthLetter
{
    private static $NUMBERS = [
        1 , 2 , 3 , 4 , 5 , 6 , 7 , 8 , 9 , 10 , 11 , 12
    ];

    private static $TONUMBERS = [
        1 =>'Enero',
        2 =>'Febrero',
        3 =>'Marzo',
        4 =>'Abril',
        5 =>'Mayo',
        6 =>'Junio',
        7 =>'Julio',
        8 =>'Agosto',
        9 =>'Septiembre',
        10 =>'Octubre',
        11 =>'Noviembre',
        12 =>'Diciembre',
        0 =>'Enero',
        13 =>'Enero',
    ];

    private static $TOLETTERS = [
        'Enero' => 1 ,
        'Febrero'=> 2 ,
        'Marzo'=> 3 ,
        'Abril'=> 4 ,
        'Mayo'=> 5 ,
        'Junio'=> 6 ,
        'Julio'=> 7 ,
        'Agosto'=> 8 ,
        'Septiembre'=> 9 ,
        'Octubre'=> 10 ,
        'Noviembre'=> 11 ,
        'Diciembre'=> 12 ,
        'Enero' => 0 ,
        'Enero'=> 13 ,
    ];

    public static function toLetter($number)
    {
        return MonthLetter::$TOLETTERS[$number];
    }

    private static function toNumber($letter)
    {
        return MonthLetter::$NUMBERS[$letter];
    }

    private static function nextMonth($letter)
    {
        return MonthLetter::toLetter( MonthLetter::toNumber($letter) + 1 );
    }
    private static function previuosMonth($letter)
    {
        return MonthLetter::toLetter( MonthLetter::toNumber($letter) - 1 );
    }
}