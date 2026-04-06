<?php  use Illuminate\Support\Facades\Route; use App\Http\Controllers\HomeController; 
 
//Route::get('/', function () { 
  //  return view('welcome'); 
//}); 
 
Route::get('/', [HomeController::class, 'index']); 
Route::get('/contact', [HomeController::class, 'contact']); 
Route::get('/index2', [HomeController::class, 'index2']); 