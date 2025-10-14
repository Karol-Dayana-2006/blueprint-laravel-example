@extends('templates.base')
@section('title', 'Categorías')
@section('subtitle', 'Crear')
@section('content') 
    @include('templates.messages')

    <div class="row p-2">
        <div class="col-lg-12 mb-4">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="col-lg-12 row">                   
                    <label>Nombre:</label>
                    <input type="text" class="form-control" name="name" placeholder="Nombre" required>                    
                </div>
                <div class="col-lg-12 row">                    
                    <label>Descripción:</label>
                    <input type="text" class="form-control" name="description" placeholder="Descripción">                   
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