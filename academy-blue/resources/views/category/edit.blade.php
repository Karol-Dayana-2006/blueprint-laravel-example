@extends('templates.base')
@section('title', 'Categorías')
@section('subtitle', 'Editar')
@section('content') 
    @include('templates.messages')

    <div class="row p-2">
        <div class="col-lg-12 mb-4">
            <form action="{{ route('categories.update', $category['id']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-lg-12 row">                   
                    <label>Nombre:</label>
                    <input type="text" class="form-control" name="name" placeholder="Nombre" required value="{{ $category['name'] }}">                    
                </div>
                <div class="col-lg-12 row">                    
                    <label>Descripción:</label>
                    <input type="text" class="form-control" name="description" placeholder="Descripción" value="{{ $category['description'] }}">                   
                </div>
                <div class="col-lg-12 row pt-4">
                   <div class="col-lg-6">
                        <button type="submit" class="btn btn-success btn-block btn-fill">Guardar</button>
                    </div>
                    <div class="col-lg-6">
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-block btn-fill">Cancelar</a>
                    </div>                  
                </div>
            </form>
        </div>
    </div>

@endsection