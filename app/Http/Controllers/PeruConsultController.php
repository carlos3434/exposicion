<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Http\Request;

//use GuzzleHttp\Client;
use Peru\Http\ContextClient;
use Peru\Jne\{Dni, DniParser};
use Peru\Sunat\{HtmlParser, Ruc, RucParser};
use Peru\Sunat\UserValidator;

class PeruConsultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dni($dni)
    {
        $cs = new Dni(new ContextClient(), new DniParser());
        $person = $cs->get($dni);
        if (!$person) {
            return response()->json('Not found', 404);
        }
        return response()->json($person, 201);
    }
    public function ruc($ruc)
    {
        $cs = new Ruc(new ContextClient(), new RucParser(new HtmlParser()));
        $company = $cs->get($ruc);
        if (!$company) {
            return response()->json('Not found', 404);
        }
        return response()->json($company, 201);
    }
    public function sol($ruc , $u)
    {
        $cs = new UserValidator(new ContextClient());
        $valid = $cs->valid($ruc, $u);
        if ($valid) {
            return response()->json('valido', 200);
        } else {
            return response()->json('no valido', 200);
        }
    }

}
