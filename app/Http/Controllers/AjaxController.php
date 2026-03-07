<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    /**
     * Simple index stub for AJAX entrypoint.
     */
    public function index(Request $request)
    {
        // Return a minimal JSON response so route:list and the app don't break.
        return response()->json(['status' => 'ok']);
    }
}
