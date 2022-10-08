<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('/git-pull', function (Request $request) {
    // sudo -u www-data ssh-keygen - генерим ssh ключи под www-data
    // chmod 600 /var/www/.ssh/ida_rsa - для работы git pull под www-data
    echo 'git pull start' . PHP_EOL;
    echo shell_exec('git pull');
    echo 'git pull complete' . PHP_EOL;
});
