<?php

require_once __DIR__ . '/../src/Support/helpers.php';
require_once base_path('/vendor/autoload.php');
require_once base_path('/routes/web.php');

$env = Dotenv\Dotenv::createImmutable(base_path());
$env->load();

app()->run();


/**
 * @description This is a test for the validator
 */
/*$validator = new \MgahedMvc\Validation\Validator();
$data = [
    'username' => '**',
    'password' => '12345',
    'email' => 'mgahed@gmail'
];
$validator->make($data,[
    'username' => ['required', 'alnum', 'between:3,6'],
    'password' => 'required|alnum|min:6',
    'email' => 'required|email'
]);
dump($validator->errors());*/
//dump(config('database.username'));