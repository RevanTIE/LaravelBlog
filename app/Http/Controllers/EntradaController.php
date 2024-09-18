<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use Illuminate\Http\Request;
use App\Http\Requests\EntradaFormRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ComentarioFormRequest;
use App\Models\Comentario;
use Auth;
use Illuminate\Support\Facades\Gate;
//use Validator;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $entradas = DB::table('entradas')
                        ->select('id','titulo', 'created_at', \DB::raw('SUBSTRING(contenido,1,200) as contenido'))
                        ->where('titulo','LIKE','%'.$texto.'%')
                        ->where('user_id','=',Auth::user()->id)
                        ->orderBy('id','desc')
                        ->paginate(10);

        //$entradas = Entrada::all();
        return view('entrada.index', compact('entradas', 'texto'));
        // echo $request->path();
        // echo "<br>";
        // echo $request->url();
        //echo $request->input('titulo');
        // return response("Respuesta", 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('entrada.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EntradaFormRequest $request) //Se inyecta la dependencia a la clase EntradaFormRequest
    {
        /**
         * Es mala practica validar aqui
         */
        // $validator = Validator::make($request->all(), [
        //     'titulo' =>'required|min:5|max:70',
        //     'contenido' =>'required|min:5|max:255'
        // ]);
        // if($validator->fails()){
        //     return redirect()
        //     ->route('entrada.create')
        //     ->withErrors($validator)
        //     ->withInput();
        // }

        // dd($request->all());
        $entrada = new Entrada;
        $entrada->titulo= $request->input('titulo');
        $entrada->contenido= $request->input('contenido');
        $entrada->user_id=Auth::user()->id; //Esta es otra manera de obtener el id: $request->user()->id;
        $entrada->save();
        return redirect()->route('entrada.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Entrada $entrada)
    {
        $comentarios = DB::table('comentarios')
                        ->join('users','comentarios.user_id','=','users.id')
                        ->where('comentarios.entrada_id','=',$entrada->id)
                        ->select('users.email', 'users.name', 'comentarios.contenido', 'comentarios.created_at')
                        ->orderBy('comentarios.id', 'desc')
                        ->get();
        return view('entrada.show', compact('entrada','comentarios'));
    }
    public function comentarioGuardar(ComentarioFormRequest $request){
        $comentario = new Comentario();
        $comentario->contenido= $request->input('contenido'); //Estos valores vienen desde la vista
        $comentario->entrada_id= $request->input('entrada_id');
        $comentario->user_id= Auth::user()->id;
        $comentario->save(); //Para guardar ese comentario
        return redirect()
                ->route('entrada.show', ['entrada'=>$request->input('entrada_id')])
                ->with('mensaje', trans('main.registered-data')); //Con input obtengo el id
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entrada $entrada)
    {
        return view('entrada.edit',compact('entrada'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EntradaFormRequest $request, Entrada $entrada)
    {
        if(Auth::user()->cant('update', $entrada)){
            return redirect()->route('entrada.index')
            ->with('mensaje', trans('main.no-authorized'));
        }

        $entrada->titulo = $request->input('titulo');
        $entrada->contenido=$request->input('contenido');
        $entrada->save();
        return redirect()
                ->route('entrada.edit', ['entrada'=>$entrada])
                ->with('mensaje', trans('main.updated-data'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrada $entrada)
    {
        //$this->authorize('delete', $entrada);
        // if(Auth::user()->cant('delete', $entrada)){
        if(Gate::denies('deleteEntrada', $entrada)){
            return redirect()->route('entrada.index')
            ->with('mensaje', trans('main.no-authorized'));
        }
        $entrada->delete();
        return redirect()->route('entrada.index');
    }
}
