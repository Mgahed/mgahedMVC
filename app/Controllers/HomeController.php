<?php
namespace App\Controllers;

use MgahedMvc\Http\Request;

class HomeController
{
    public function index()
    {
        $request = new Request;
        $name = $request->all()['name'] ?? 'Guest';
        return view('home',['name' => $name]);
    }
}