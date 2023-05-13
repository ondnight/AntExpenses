<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\InformeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Detalle_InformeController;

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

//rutas del auth register

Route::get('/register',[RegisterController::class,'index'])->name('register'); //ruta del registro
Route::post('/register',[RegisterController::class,'store'])->name('register'); //ruta form registro

//rutas del auth login y logout

Route::get('/login',[LoginController::class,'index'])->name('login'); //ruta del login
Route::post('/login',[LoginController::class,'store'])->name('login'); //ruta para el envio del form del login
Route::get('/{user:usuario}/dashboard/', [PostController::class, 'index'])->name('posts.index'); // redireccion al dashboard
Route::post('/logout',[LogoutController::class,'store'])->name('logout'); //ruta para cerrar sesión. Usamos post para dar seguridad con csrf

//rutas para gestión de tickets
Route::get('/{user:usuario}/tickets/',[TicketController::class,'index'])->name('tickets.index');//listado de tickets
Route::get('/{user:usuario}/informed/',[TicketController::class,'informed'])->name('tickets.informed');
Route::get('/tickets/create',[TicketController::class,'create'])->name('tickets.create');//formulario para crear ticket
Route::post('/tickets',[TicketController::class,'store'])->name('tickets.store');//guardar el ticket
Route::get('/tickets/edit/{ticket:id}',[TicketController::class,'edit'])->name('tickets.edit');//abre la ventana de edición de ticket
Route::put('/tickets/edit/{ticket:id}',[TicketController::class,'update'])->name('tickets.update'); //actualiza el ticket editado
Route::delete('/tickets/borrar/{ticket:id}',[TicketController::class, 'destroy'])->name('tickets.destroy'); //elimina ticket

//rutas para gestión de informes
Route::get('/{user:usuario}/informes/',[InformeController::class,'index'])->name('informes.index');//listado de informes
Route::get('/informes/create',[InformeController::class,'create'])->name('informes.create');//formulario para crear informes
Route::post('/informes',[InformeController::class,'store'])->name('informes.store'); //guarda informe nuevo
Route::get('/informes/edit/{informe:id}',[InformeController::class,'edit'])->name('informes.edit'); //editar informe
Route::put('/informes/edit/{informe:id}',[InformeController::class,'update'])->name('informes.update'); //actualiza el informe editado
Route::delete('/informes/{informe:id}',[InformeController::class,'destroy'])->name('informes.destroy'); // borra el informe
Route::get('/{user:usuario}/informes/addticket/{informe:id}',[InformeController::class,'addTickets'])->name('informes.addticket'); //abre ventana para añadir tickets al informe
Route::post('/{user:usuario}/informes/addticket/{informe:id}',[Detalle_InformeController::class,'addTicket'])->name('informes.addticket'); // añade tickets al informe
Route::post('/{user:usuario}/informes/sendreport/{informe:id}',[InformeController::class,'sendReport'])->name('informes.sendreport'); //envia informe para ser evaluado
Route::get('/{user:usuario}/informes/sent',[InformeController::class,'sent'])->name('informes.sent'); // listado informes enviados
Route::get('/{user:usuario}/informes/quitarticket/{informe:id}',[InformeController::class,'quitarTickets'])->name('informes.quitarticket'); //abre ventana para quitar tickets
Route::post('/{user:usuario}/informes/quitarticket/{informe:id}',[Detalle_InformeController::class,'quitarTicket'])->name('informes.quitarticket'); //quita tickets del informe

Route::get('/perfil/{user:usuario}', [PerfilController::class, 'index'])->name('perfil.index'); //abre ventana para editar usuario
Route::put('/perfil/{user:usuario}', [PerfilController::class, 'update'])->name('perfil.update'); //actualiza información del usuario
Route::get('/perfil/changepass/{user:usuario}',[PerfilController::class, 'changePassword'])->name('perfil.changePassword'); //abre ventana para cambiar contraseña
Route::post('/perfil/updatepass/{user:usuario}',[PerfilController::class, 'updatePassword'])->name('perfil.updatePassword'); //guarda la contraseña nueva

Route::get('/{user:usuario}',[AdminController::class,'index'])->name('admin.index'); //dashboard del admin
Route::get('/{user:usuario}/listadoinformes/',[AdminController::class,'informes'])->name('admin.informes'); //gestion de informes
Route::get('/{user:usuario}/listadoinformes/pending/',[AdminController::class,'pending'])->name('admin.pending'); //informes pendientes
Route::get('/{user:usuario}/listadoinformes/completed/',[AdminController::class,'completed'])->name('admin.completed'); //informes completados
Route::get('/{user:usuario}/listadoinformes/pending/tickets/{informe:id}',[AdminController::class,'listadoTickets'])->name('admin.listadoTickets'); //listado tickets en informes
Route::get('/{user:usuario}/listadoinformes/pending/check/{informe:id}',[AdminController::class,'check'])->name('admin.check'); //abre ventana para evaluar informe
Route::put('/{user:usuario}/listadoinformes/pending/check/{informe:id}',[AdminController::class,'update'])->name('admin.check'); // envia evaluación
