<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SourcesController extends Controller
{
    public function create($id, $name)
    {
        return view('index',['id' => $id,'name' => $name]);
    }

    public function edit($id, $name)
    {
        return view('edit',['id' => $id,'name' => $name]);
    }
}
