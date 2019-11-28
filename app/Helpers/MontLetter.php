<?php
namespace App\Helpers;

class MonthLetter
{

    private static $TONUMBERS = [
        0 =>'DICIEMBRE',
        1 =>'ENERO',
        2 =>'FEBRERO',
        3 =>'MARZO',
        4 =>'ABRIL',
        5 =>'MAYO',
        6 =>'JUNIO',
        7 =>'JULIO',
        8 =>'AGOSTO',
        9 =>'SEPTIEMBRE',
        10 =>'OCTUBRE',
        11 =>'NOVIEMBRE',
        12 =>'DICIEMBRE',
        13 =>'ENERO',
    ];

    private static $TOLETTERS = [
        'DICIEMBRE' => 0 ,
        'ENERO' => 1 ,
        'FEBRERO'=> 2 ,
        'MARZO'=> 3 ,
        'ABRIL'=> 4 ,
        'MAYO'=> 5 ,
        'JUNIO'=> 6 ,
        'JULIO'=> 7 ,
        'AGOSTO'=> 8 ,
        'SEPTIEMBRE'=> 9 ,
        'OCTUBRE'=> 10 ,
        'NOVIEMBRE'=> 11 ,
        'DICIEMBRE'=> 12 ,
        'ENERO'=> 13 ,
    ];

    public static function toLetter($number)
    {
        return MonthLetter::$TONUMBERS[$number];
    }

    public static function toNumber($letter)
    {
        return MonthLetter::$TOLETTERS[$letter];
    }

    public static function nextMonth($number)
    {
        if ($number > 12) {
            return MonthLetter::toLetter(1);
        }
        return MonthLetter::toLetter( (int) $number + 1);
    }
    public static function previuosMonth($number)
    {
        if ($number < 1) {
            return MonthLetter::toLetter(12);
        }
        return MonthLetter::toLetter( (int) $number - 1);
    }
}