<?php


use App\Models\category;
use App\Models\Posts;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');

//     $cat=  Posts::create([

//         "author"=>'osama',
//         "ar" =>
//         [
//            'title'=>'cat ar',
//            'content'=>'content ar...'
//         ],
//         "en"=>
//         [
//             'title'=>'cat en',
//             'content'=>'content en...'
//         ]
//   ]);

//    return $cat;


// $cat=  category::create([

//     "name"=>'osama',

//     "ar" =>
//     [

//        'name'=>'content ar...'
//     ],
//     "en"=>
//     [

//         'name'=>'content en...'
//     ]
// ]);

// return $cat;
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
