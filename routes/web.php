<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\UserActivityController;
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
    return view('/home');
})->name('/');

Route::post('/', function () {
    return view('welcome');
});



Auth::routes();
//Route::get('/register', [UserController::class, 'enviarComboEnseñanzas'])->name('registerC');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Acciones del encargado sobre los usuarios.
Route::get('/usuario/listado', [UserController::class, 'listar'])->name('listado_usu');

Route::post('/crear_usu', [UserController::class, 'crearUsu'])->name('crear_usu');


Route::get('/usuario/crear_usuario',[UserController::class,'enviarComboEnseñanzas'])->name('crear_usuario');


Route::post('/eliminar_usu', [UserController::class, 'eliminar_usu'])->name('eliminar_usu');

Route::get('/editar_usu', [UserController::class, 'editar_usu'])->name('editar_usu');

Route::post('/guardar_datos_usu', [UserController::class, 'guardar_datos_usu'])->name('guardar_datos_usu');



Route::get('/listado_eliminados', [UserController::class, 'listado_usus_eliminados'])->name('listado_usus_eliminados');
Route::post('/restaura_usu', [UserController::class, 'restaura_usu'])->name('restaura_usu');
Route::post('/destruir_usu', [UserController::class, 'destruir_usu'])->name('destruir_usu');

Route::post('/descargarListado', [UserController::class, 'descargarLitadoPdf'])->name('descargar_pdf');

//Acciones del encargado sobre las acciones.
Route::get('/listado_actividades', [ActivityController::class, 'listar'])->name('listado_actividades');

Route::get('/crear_actividad', [ActivityController::class, 'combosActividad'])->name('crear_actividad');

Route::post('/guardar_actividad', [ActivityController::class,'crearActividad' ])->name('guardar_actividad');

Route::get('/editar_actividad', [ActivityController::class, 'combosEditarActividad'])->name('editar_actividad');
Route::post('/guardar_cambios_actividad', [ActivityController::class, 'actualizar_actividad'])->name('actualizar_actividad');
Route::post('/borrarActividad', [ActivityController::class, 'eliminar_actividad'])->name('borrar_actividad');


//usuarios
Route::get('/perfil', [UserController::class, 'perfil_usu'])->name('perfil');
Route::post('/actualiza_perfil', [UserController::class, 'actualizar_perfil'])->name('guardar_perfil');


//Profesor
Route::get('/mis_actividades', [UserActivityController::class,'listar'])->name('mis_actividades');
Route::post('/mis_actividades', [UserActivityController::class,'listar'])->name('mis_actividades');
Route::post('/mis_actividades_realizadas', [UserActivityController::class,'listarRealizadas'])->name('mis_actividades_realizadas');

Route::post('/participantes_actividad', [UserActivityController::class,'listarParticipantesActividad'])->name('participantes_actividad');
Route::get('/actividades', [UserActivityController::class,'listarTodas'])->name('actividades');

Route::post('/anular_actividad', [UserActivityController::class,'anularActividad'])->name('anular_actividad');
Route::post('/inscribir_actividad', [UserActivityController::class,'inscribirActividad'])->name('inscribir_actividad');
Route::post('/actividades_cuerpos', [UserActivityController::class,'listarCuerpo'])->name('actividades_cuerpos');

Route::post('/procesar_cambio', [UserActivityController::class,'procesarCambioActividad'])->name('procesar_cambios');

Route::post('/listado_actividades_pdf', [ActivityController::class,'descargarListadoPDF'])->name('listado_actividades_pdf');


Route::post('/listado_participantes_pdf', [UserActivityController::class,'descargarparticipantesPDF'])->name('descargar_pdf_participantes');
