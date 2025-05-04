<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ArtistaController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\DetalleCompraController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\PDFController;

use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('Clientes', ClienteController::class);
Route::resource('Artistas', ArtistaController::class);
Route::resource('Reservas', ReservaController::class);
Route::resource('Productos', ProductoController::class);
Route::resource('Proveedores', ProveedorController::class);
Route::resource('Compras', CompraController::class);
Route::resource('DetallesCompras', DetalleCompraController::class);
Route::resource('DetallesVentas', DetalleVentaController::class);
Route::resource('Ventas', VentaController::class);

Route::post('/chatbot/respond', [ChatbotController::class, 'respond'])->name('admin.chatbot.respond');
Route::get('/chatbot', function () {
    return view('admin.chatbot');
})->name('admin.chatbot');

Route::get('/reporte/pdf', [PDFController::class, 'generarPDF'])->name('reporte.pdf');
