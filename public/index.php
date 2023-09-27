<?php

require_once __DIR__ . '/../src/Support/helpers.php';
require_once base_path('/vendor/autoload.php');
require_once base_path('/routes/web.php');

$env = Dotenv\Dotenv::createImmutable(base_path());
$env->load();

app()->run();


/**
 * @description This is a test for the model crud
 */
/*dump(app()->db->raw('SELECT * FROM users where id = ?', [1]));
dump(\App\Models\User::create(['username' => 'mgahedc', 'email'=>'a@a.comz', 'password' => bcrypt('123456c')]));
dump(app()->db->raw('INSERT INTO users (username, email, password) VALUES (?, ?, ?)', ['mgahedinsert', 'mins@mins.com', bcrypt('123456c')]));
dump(\App\Models\User::update('1', ['username' => 'mgahedcUpdate']));
dump(\App\Models\User::where(['id', '=', '1']));
dump(\App\Models\User::delete('1'));*/


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