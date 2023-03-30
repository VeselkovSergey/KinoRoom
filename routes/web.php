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

Route::any('/git-pull', function () {
    echo '<pre>';
// sudo -u www-data ssh-keygen - генерим ssh ключи под www-data
// chmod 600 /var/www/.ssh/ida_rsa - для работы git pull под www-data
    echo 'git pull start' . PHP_EOL;
    echo shell_exec('git pull');
    echo 'git pull complete' . PHP_EOL;

    echo 'composer start' . PHP_EOL;
    echo shell_exec('composer install');
    echo 'composer complete' . PHP_EOL;
    echo '</pre>';
})->name('git-pull');

Route::get('/get-analytics', function () {
    return view("analytics", ["analytics" => \App\Models\Analytics::all()]);
})->name("analytics");

Route::get('/analytics-detail/{id}', function () {
    return view("analytics-detail", ["analytics" => \App\Models\Analytics::find(request()->id)]);
})->name("analytics-detail");


Route::get('/', function () {
//    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect(\route('search'));
//    } else {
//        return redirect(\route('login'));
//    }
})->name('home');

//Route::get('/registration', function () {
//    \Illuminate\Support\Facades\Auth::logout();
//    if (request('neon')) {
//        return view('neon.registration');
//    } else {
//        return view('registration');
//    }
//
//})->name('registration');

//Route::group(['prefix' => '/login'], function () {
//
//    Route::get('/', function () {
//        if (request('neon')) {
//            return view('neon.login');
//        } else {
//            return view('login');
//        }
//    })->name('login-page');
//
//    Route::post('/', function () {
//        $user = \App\Models\User::where('email', request('login'))->firstOrFail();
//        if (\Illuminate\Support\Facades\Hash::check(request('password'), $user->password)) {
//            \Illuminate\Support\Facades\Auth::login($user);
//        } else {
//            throw new Exception('Ошибка авторизации');
//        }
//    })->name('login');
//
//});

//Route::group(['middleware' => 'auth'], function () {
//
//    Route::get('/logout', function () {
//        \Illuminate\Support\Facades\Auth::logout();
//        return redirect(\route('home'));
//    })->name('logout');
//
//    Route::get('/subscription', function () {
//        return view('subscription');
//    })->name('subscription');
//
//    Route::post('/subscription', function () {
//        $subscriptionType = request('type');
//
//        $userSubscriptionEndDate = \Carbon\Carbon::parse(auth()->user()->subscription_end_date);
//
//        if ($subscriptionType === '30') {
//
//            if (auth()->user()->checkSubscription()) {
//                $newUserSubscriptionEndDate = $userSubscriptionEndDate->addMonth()->format('Y-m-d');
//            } else {
//                $newUserSubscriptionEndDate = now()->addMonth()->format('Y-m-d');
//            }
//
//            auth()->user()->update([
//                'subscription_start_date' => now()->format('Y-m-d'),
//                'subscription_end_date' => $newUserSubscriptionEndDate,
//            ]);
//
//        } else if ($subscriptionType === '365') {
//
//            if (auth()->user()->checkSubscription()) {
//                $newUserSubscriptionEndDate = $userSubscriptionEndDate->addYear()->format('Y-m-d');
//            } else {
//                $newUserSubscriptionEndDate = now()->addYear()->format('Y-m-d');
//            }
//
//            auth()->user()->update([
//                'subscription_start_date' => now()->format('Y-m-d'),
//                'subscription_end_date' => $newUserSubscriptionEndDate,
//            ]);
//
//        }
//
//    })->name('subscription-request');
//
//    Route::get('/profile', function () {
//        return view('profile');
//    })->name('profile');

//    Route::group(['middleware' => 'subscription'], function () {

        Route::get('/ref/{refer}', function ($refer) {
            \App\Models\Refers::create([
                'refer' => $refer,
                'client_ip_address' => request()->server('REMOTE_ADDR')
            ]);
            return redirect(\route('home'));
        });

        Route::get('/search', function () {
//            if (request('neon')) {
                return view('neon.search');
//            } else {
//                return view('search');
//            }

        })->name('search');//->middleware('auth');

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

            $filmPosterUrl = $filmInfo->poster_path !== null ? 'https://imagetmdb.com/t/p/w500' . $filmInfo->poster_path : 'https://bpic.588ku.com/back_pic/05/10/88/62598e75d484d19.jpg!/fh/300/quality/90/unsharp/true/compress/true';
            $filmBackDropUrl = $filmInfo->backdrop_path !== null ? 'https://imagetmdb.com/t/p/w1920_and_h800_multi_faces' . $filmInfo->backdrop_path : null;

//            if (request('neon')) {
                return view('neon.film', compact('filmTitle', 'filmDescription', 'filmPosterUrl', 'filmBackDropUrl', 'filmId', 'isSerial'));
//            } else {
//                return view('film', compact('filmTitle', 'filmDescription', 'filmPosterUrl', 'filmId', 'isSerial'));
//            }


        })->name('film');

//    });

//});

Route::get('/abort', function () {
    abort(404);
})->name('abort');

Route::get('/get-log', function () {
    return file_get_contents(storage_path() . '/logs/laravel.log');
});
