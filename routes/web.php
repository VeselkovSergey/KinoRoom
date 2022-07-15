<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect(\route('search'));
    } else {
        return redirect(\route('login'));
    }
})->name('home');

Route::get('/registration', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return view('registration');
})->name('registration');

Route::group(['prefix' => '/login'], function () {

    Route::get('/', function () {
        return view('login');
    })->name('login-page');

    Route::post('/', function () {
        $user = \App\Models\User::where('email', request('login'))->firstOrFail();
        if (\Illuminate\Support\Facades\Hash::check(request('password'), $user->password)) {
            \Illuminate\Support\Facades\Auth::login($user);
        } else {
            throw new Exception('Ошибка авторизации');
        }
    })->name('login');

});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/logout', function () {
        \Illuminate\Support\Facades\Auth::logout();
        return redirect(\route('home'));
    })->name('logout');

    Route::get('/subscription', function () {
        return view('subscription');
    })->name('subscription');

    Route::post('/subscription', function () {
        $subscriptionType = request('type');

        if ($subscriptionType === '30') {
            auth()->user()->update([
                'subscription_start_date' => now()->format('Y-m-d'),
                'subscription_end_date' => \Carbon\Carbon::parse(auth()->user()->subscription_end_date)->addMonth()->format('Y-m-d'),
            ]);
        } else if ($subscriptionType === '365') {
            auth()->user()->update([
                'subscription_start_date' => now()->format('Y-m-d'),
                'subscription_end_date' => \Carbon\Carbon::parse(auth()->user()->subscription_end_date)->addYear()->format('Y-m-d'),
            ]);
        }

    })->name('subscription-request');

    Route::get('/search', function () {
        return view('search');
    })->name('search')->middleware('auth');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('/film', function () {

        $filmId = request('id');
        $isSerial = request('isSerial');

        $url = 'https://apitmdb.cub.watch/3/' . ($isSerial === 'true' ? 'tv' : 'movie') . '/' . $filmId . '?api_key=4ef0d7355d9ffb5151e987764708ce96&language=ru';

        try {
            $filmInfoRaw = file_get_contents($url);
        } catch (Exception $e) {
            return abort(404);
        }

        $filmInfo = json_decode($filmInfoRaw);

        $filmTitle = ($filmInfo->title ?? $filmInfo->name) . ' (' . ($filmInfo->release_date ?? $filmInfo->first_air_date) . ')';
        $filmDescription = $filmInfo->overview;

        $filmPosterUrl = $filmInfo->poster_path !== null ? 'https://imagetmdb.cub.watch/t/p/w200' . $filmInfo->poster_path : 'https://bpic.588ku.com/back_pic/05/10/88/62598e75d484d19.jpg!/fh/300/quality/90/unsharp/true/compress/true';

        return view('film', compact('filmTitle', 'filmDescription', 'filmPosterUrl', 'filmId', 'isSerial'));

    })->name('film');

});

Route::get('/abort', function () {
    abort(404);
})->name('abort');


