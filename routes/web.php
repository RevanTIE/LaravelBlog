<?php

use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\DB;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/estructuras/{numero?}', function($numero=0){
//     return view('estructuras', compact("numero"));
// });

// Route::get('/estructuras', function(){
//     $lista = ["Plátano", "Naranja", "Uvas", "Mandarinas"];
//     return view('estructuras', compact("lista"));
// });

Route::get('/estructuras', function(){
    return view('estructuras');
});
// Route::get('/consulta', function(){
//     $usuarios = DB::table('users')->select(['name', 'email'])->get();
//     dd($usuarios);
// });

Route::get('/consulta', function(){
    $entradas = DB::table('entradas')
    ->join('users', 'entradas.user_id', '=', 'users.id')
    ->select(['users.*', 'entradas.titulo AS title'])
    ->get();
    // ->where('user_id','=',2)
    // ->get();
    //dd es como el vardump en php
    dd($entradas);
});
Route::get('/insertar', function(){
    $insertado = DB::table('users')
    ->insertGetId([
        "name" => "Juan Montenegro",
        "email" => "juan_montenegro@prueba.com",
        "password" => "monte"
    ]);
    dd($insertado);
});

Route::get('/update', function(){
    $insertado = DB::table('users')
    ->where('id', '=', '8')
    ->update(
        [
            "name" => "Paula Mejia",
            "email" => "paulamedia@prueba.com",
            "password" => "paula"
        ]
        );
    dd($insertado);
});

Route::get('/delete', function(){
    $insertado = DB::table('users')
    ->where('id', '=', '8')
    ->delete();
    dd($insertado);
});



Route::view('/prueba', 'prueba');

Route::view('/producto', 'producto.index');


Route::view('/ventas', 'ventas.index');


Route::get('/vue', function(){
    return view('pruebavue');
});

// Route::get('/probarconexion',function(){
//     try{
//         DB::connection()->getPdo();
//         echo 'Conexión exitosa';
//     } catch(\Exception $e){
//         die("No se puede Conectar a la base de datos. Revise porfavor su configuración.
//         Error: ".$e);
//     }
// });


//Route::view('/producto', 'producto');

// Route::get('/producto', function(){
//     return view('producto', ["nombre"=>"Impresora LX300", "marca"=>"Epson"]);
// });

// Route::get('/producto', function(){
//     $nombre= "Impresora LX300";
//     $marca= "Philips";
//     return view('producto',compact("nombre", "marca"));
//     //->with(["nombre"=>"Impresora LX300", "marca"=>"Epson"]);
// });

// Route::get('/usuario', function(){
//     $nombre = 'Juan Carlos';
//     return "Hola Usuario {$nombre}";
// });



Route::group(['prefix'=>'admin'], function(){
    Route::get('usuario/{nombre?}/{apellidos?}', function($nombre="", $apellidos =""){
        return "Hola usuario {$nombre} {$apellidos}";
    }
    )->where(['nombre'=>'[A-Za-z]+','apellidos'=>'[A-Za-z]+']);
    Route::any('/cliente', function(){
        return "Cliente";
    });
});
// Route::get('/email/verify', function(){
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request){
//     $request->fulfill();

//     return redirect('/profile');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();
// });

Auth::routes(['verify'=>'true']);
Route::group(['middleware'=>'verified'],function(){
    Route::resource('/entrada', 'App\Http\Controllers\EntradaController');
    Route::post('/entrada/comentario', 'App\Http\Controllers\EntradaController@comentarioGuardar')->name('comentario.guardar');
    Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
});
Route::get('/', 'App\Http\Controllers\BlogController@index')->name('blog.index');
Route::get('/blog/{id?}','App\Http\Controllers\BlogController@show')->name('blog.show');



