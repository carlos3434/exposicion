<?php
namespace App\Helpers;

class MonthLetter
{

    private static $TONUMBERS = [
        //0 =>'DICIEMBRE',
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
        //13 =>'ENERO',
    ];

    private static $TOLETTERS = [
        //'DICIEMBRE' => 0 ,
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
        //'ENERO'=> 13 ,
    ];

    public static function toLetter($number)
    {
        return MonthLetter::$TONUMBERS[$number];
    }

    public static function toNumber($letter)
    {
        return MonthLetter::$TOLETTERS[$letter];
    }

    public static function nextMonth($letter, $months = 1)
    {
        $number = self::toNumber( $letter );
        return self::toLetter(self::nextMonthNumber($number,$months));
    }
    public static function nextMonthNumber($number, $months = 1)
    { //dd($number, $months);
        if (($number + $months) > 12) {
            return $number + $months - 12;
        }
        return  (int) $number + $months;
    }
    public static function previuosMonth($letter, $months = 1)
    {
        $number = self::toNumber( $letter );
        return self::toLetter(self::previuosMonthNumber($number,$months));
    }
    public static function previuosMonthNumber($number, $months = 1)
    {
        if (($number - $months) < 1) {
            return $number - $months + 12;
        }
        return  (int) $number - $months;
    }
}