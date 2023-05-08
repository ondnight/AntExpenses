<?php

use App\Http\Controllers\Detalle_InformeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\InformeController;
use App\Http\Controllers\RegisterController;

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
    return view('principal');
});

//rutas del auth

Route::get('/register',[RegisterController::class,'index'])->name('register'); //ruta del registro
Route::post('/register',[RegisterController::class,'store'])->name('register'); //ruta form registro

Route::get('/login',[LoginController::class,'index'])->name('login'); //ruta del login
Route::post('/login',[LoginController::class,'store'])->name('login'); //ruta para el envio del form del login

Route::post('/logout',[LogoutController::class,'store'])->name('logout'); //ruta para cerrar sesión. Usamos post para dar seguridad con csrf

Route::get('/{user:usuario}/tickets/',[TicketController::class,'index'])->name('tickets.index');//listado de tickets
Route::get('/{user:usuario}/informed/',[TicketController::class,'informed'])->name('tickets.informed');
Route::get('/tickets/create',[TicketController::class,'create'])->name('tickets.create');//formulario para crear ticket
Route::post('/tickets',[TicketController::class,'store'])->name('tickets.store');
Route::get('/tickets/edit/{ticket:id}',[TicketController::class,'edit'])->name('tickets.edit');
Route::put('/tickets/edit/{ticket:id}',[TicketController::class,'update'])->name('tickets.update');
Route::delete('/tickets/borrar/{ticket:id}',[TicketController::class, 'destroy'])->name('tickets.destroy');

Route::get('/{user:usuario}/informes/',[InformeController::class,'index'])->name('informes.index');//listado de informes
Route::get('/informes/create',[InformeController::class,'create'])->name('informes.create');//formulario para crear informes
Route::post('/informes',[InformeController::class,'store'])->name('informes.store');
Route::get('/informes/edit/{informe:id}',[InformeController::class,'edit'])->name('informes.edit');
Route::get('/{user:usuario}/informes/addticket/{informe:id}',[InformeController::class,'addTickets'])->name('informes.addticket');
Route::post('/{user:usuario}/informes/addticket/{informe:id}',[Detalle_InformeController::class,'addTicket'])->name('informes.addticket');
Route::post('/{user:usuario}/informes/sendreport/{informe:id}',[InformeController::class,'sendReport'])->name('informes.sendreport');
Route::get('/{user:usuario}/informes/sent',[InformeController::class,'sent'])->name('informes.sent'); // listado informes enviados
Route::get('/{user:usuario}', [PostController::class, 'index'])->name('posts.index'); // redireccion al dashboard
Route::delete('/informes/{informe:id}',[InformeController::class,'destroy'])->name('informes.destroy');
Route::put('/informes/edit/{informe:id}',[InformeController::class,'update'])->name('informes.update');

Route::get('/{user:usuario}/informes/quitarticket/{informe:id}',[InformeController::class,'quitarTickets'])->name('informes.quitarticket');
Route::post('/{user:usuario}/informes/quitarticket/{informe:id}',[Detalle_InformeController::class,'quitarTicket'])->name('informes.quitarticket');

Route::get('/perfil/{user:usuario}', [PerfilController::class, 'index'])->name('perfil.index');
Route::put('/perfil/{user:usuario}', [PerfilController::class, 'update'])->name('perfil.update');
Route::get('/perfil/changepass/{user:usuario}',[PerfilController::class, 'changePassword'])->name('perfil.changePassword');
Route::post('/perfil/updatepass/{user:usuario}',[PerfilController::class, 'updatePassword'])->name('perfil.updatePassword');

