<?php
namespace App\Controllers;

use MgahedMvc\Http\Request;
use MgahedMvc\Validation\Validator;

class HomeController
{
    public function index()
    {
        $validator = new Validator();
        $request = new Request;
        $validator->make($request->all(),[
            'name' => 'required|min:3'
        ]);
        if($validator->errors()){
            $errors = $validator->errors();
            return view('errors/errors',['errors' => $errors]);
        }
        $name = $request->all()['name'] ?? 'Guest';
        return view('home',['name' => $name]);
    }
}