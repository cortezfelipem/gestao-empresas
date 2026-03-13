<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientTempController extends Controller
{
    public function index()
    {
        return redirect('/graficos');
    }

    public function store(Request $request)
    {
        return redirect('/graficos');
    }

    public function update(Request $request, $id)
    {
        return redirect('/graficos');
    }

    public function destroy($id)
    {
        return redirect('/graficos');
    }
}
