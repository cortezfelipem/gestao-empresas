<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplianceNotFounController extends Controller
{
    public function index()
    {
        return redirect('/graficos');
    }

    public function delete($id)
    {
        return redirect('/graficos');
    }
}
