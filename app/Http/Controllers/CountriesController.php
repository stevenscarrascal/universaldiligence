<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountriesController extends Controller
{
    public function show($id, $name)
    {
        return view('show',['id' => $id,'name' => $name]);
    }
}
