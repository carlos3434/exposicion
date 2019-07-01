<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailController extends Controller
{

    public function Sending_Email()
    {
     	$this->call('GET','Email.test');
        return View('Email.test');
    }
}
