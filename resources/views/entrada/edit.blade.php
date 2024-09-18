@extends('layouts.app')
@section('content')
    @if(Session::has('mensaje'))
        <div class="row justify-content-center">
            <div class="col-sm-7">
                <div class="alert alert-success">
                   {{Session::get('mensaje')}}
                </div>
            </div>
        </div>
    @endif
    @if($errors->any())
    <div class="row justify-content-center">
        <div class="col-sm-7">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif
<form method="post" action="{{route('entrada.update', ['entrada'=>$entrada])}}">
    @method('PUT')
    @csrf
    <div class="row justify-content-center">
        <div class="col-sm-7">
            <div class="form-group">
                <label for="titulo">@lang('main.title')</label>
                <input type="text" class="form-control" name="titulo" id="titulo" value="{{$entrada->titulo}}" placeholder="Titulo">
            </div>
            <div class="form-group">
                <label for="contenido">@lang('main.content')</label>
                <textarea class="form-control" name="contenido" id="contenido" cols="30" rows="10" maxlength="255">{{$entrada->contenido}}</textarea>
            </div>
        </div>
        <div class="col-sm-7 text-center">
            <button class="btn btn-primary btn-block" type="submit">@lang('main.edit')</button>&nbsp;
            <a class="btn btn-secondary btn-block" href="javascript:history.back()">@lang('main.go-back')</a>
        </div>

    </div>
</form>
@endsection