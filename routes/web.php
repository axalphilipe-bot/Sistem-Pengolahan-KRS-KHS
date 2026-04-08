<?php  use Illuminate\Support\Facades\Route; use App\Http\Controllers\HomeController; 
 
//Route::get('/', function () { 
  //  return view('welcome'); 
//}); 
 
Route::get('/', function () {
    return view('welcome'); // atau dashboard kamu
})->name('home');
Route::get('/krs', function () {
    return view('krs');
});
Route::get('/khs', function () {
return view('khs');
})->name('khs');