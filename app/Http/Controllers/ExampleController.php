<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ExampleController extends Controller
{
    public function index()
    {
        $examples = DB::table('examples')->get();
        return view('example.index', compact('examples'));
    }
}