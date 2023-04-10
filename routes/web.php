<?php

use App\Http\Controllers\ProductsController;
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
    return view('auth.login');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* 一覧画面*/
Route::get('/test_views', [ProductsController::class, 'index'])->name('products.index');
Route::get('/search', [ProductsController::class, 'search'])->name('crud.index');

/* 削除*/
Route::post('/destroy{id}', [ProductsController::class, 'destroy'])->name('product.destroy');

/*登録画面 */
Route::get('/products_register', [ProductsController::class, 'create'])->name('create');

/*登録処理 */
Route::post('/products_register', [ProductsController::class, 'store'])->name('newproduct.store');

/*詳細画面 */
Route::get('/show/{id}', [ProductsController::class, 'show'])->name('product.show');

/*編集画面 */
Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('product.edit');

/*商品更新 */
Route::post('/update/{id}', [ProductsController::class, 'update'])->name('product.update');

