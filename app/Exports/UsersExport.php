<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromArray;
//use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromArray, WithStrictNullComparison, WithHeadings
{
    //use Exportable;
    /*
    public function collection()
    {
        return User::all();
    }*/
    protected $users;

    public function __construct(array $users, $headings)
    {
        $this->users = $users;
        $this->headings = $headings;
    }

    public function array(): array
    {
        return $this->users;
    }
    /*public function startCell()
    {
        return 'B2';
    }*/
    public function headings() : array
    {
        return $this->headings;
    }
}