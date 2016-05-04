<?php

namespace Milax\Mconsole\Commerce\Http\Controllers;

use App\Http\Controllers\Controller;

class CommerceController extends Controller
{
    public function index()
    {
        return view('mconsole::commerce.index');
    }
}
