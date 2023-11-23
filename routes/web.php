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
    $fromDate = request()->get('date') ?? now();
    $fromDate = \Carbon\Carbon::parse($fromDate)->startOfDay();
    $analytics = \App\Models\Analytics::where('created_at', '>=', $fromDate)->get();
    return view("analytics", ["analytics" => $analytics]);
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

            $apiKey = "4ef0d7355d9ffb5151e987764708ce96";

            $filmId = request('id');
            $isSerial = request('isSerial');

            $url = 'https://apitmdb.cub.red/3/' . ($isSerial === 'true' ? 'tv' : 'movie') . '/' . $filmId . '?api_key='.$apiKey.'&language=ru';
            $urlForId = 'https://apitmdb.cub.red/3/'.($isSerial === 'true' ? 'tv' : 'movie').'/'.$filmId.'/external_ids?api_key='.$apiKey.'&language=ru';

            try {
                $filmInfoRaw = file_get_contents($url);
                $filmIdsRaw = file_get_contents($urlForId);
            } catch (Exception $e) {
                return abort(404);
            }

            $filmInfo = json_decode($filmInfoRaw);
            $filmInfoIds = json_decode($filmIdsRaw);

            $filmId = $filmInfo->id;
            $filmImdbId = $filmInfoIds->imdb_id;

            $filmTitle = ($filmInfo->title ?? $filmInfo->name) . ' (' . ($filmInfo->release_date ?? $filmInfo->first_air_date) . ')';
            $filmRawTitle = $filmInfo->title ?? $filmInfo->name;
            $filmDescription = $filmInfo->overview;

            $filmPosterUrl = $filmInfo->poster_path !== null ? 'https://imagetmdb.com/t/p/w500' . $filmInfo->poster_path : 'https://bpic.588ku.com/back_pic/05/10/88/62598e75d484d19.jpg!/fh/300/quality/90/unsharp/true/compress/true';
            $filmBackDropUrl = $filmInfo->backdrop_path !== null ? 'https://imagetmdb.com/t/p/w1920_and_h800_multi_faces' . $filmInfo->backdrop_path : null;

//            if (request('neon')) {
                return view('neon.film', compact('filmRawTitle','filmTitle', 'filmDescription', 'filmPosterUrl', 'filmBackDropUrl', 'filmId', 'isSerial', 'filmImdbId', 'filmInfo'));
//            } else {
//                return view('film', compact('filmTitle', 'filmDescription', 'filmPosterUrl', 'filmId', 'isSerial'));
//            }


        })->name('film');

        Route::get('/get-iframe-content', function () {
            $ch = curl_init();

// 2. The URL containing the iframe

            $url = "http://53906.svetacdn.in/tQ7mudXLQUUG/movie/11666";
            $url = "http:" . request()->get("iframeSrc");

// 3. set the options, including the url

            curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 2);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
//    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
//    'Accept-Encoding: gzip, deflate, br',
//    'Accept-Language: ru,en;q=0.9,en-GB;q=0.8,en-US;q=0.7',
//    'Cache-Control: no-cache',
//    'Pragma: no-cache',

                'Referer: http://test.local/',

//    'Sec-Ch-Ua: "Not.A/Brand";v="8", "Chromium";v="114", "Microsoft Edge";v="114"',
//    'Sec-Ch-Ua-Mobile: ?0',
//    'Sec-Ch-Ua-Platform: "Windows"',
//    'Sec-Fetch-Dest: iframe',
//    'Sec-Fetch-Mode: navigate',
//    'Sec-Fetch-Site: cross-site',
//    'Upgrade-Insecure-Requests: 1',
//    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.58',
            ]);

// 4. execute and fetch the resulting HTML output by putting into $output

            $output = curl_exec($ch);

// 5. free up the curl handle

            curl_close($ch);

            return $output;
        })->name('get-iframe-content');//->middleware('auth');

//    });

//});

Route::get('/abort', function () {
    abort(404);
})->name('abort');

Route::get('/get-log', function () {
    return file_get_contents(storage_path() . '/logs/laravel.log');
});
