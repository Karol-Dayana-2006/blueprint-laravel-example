@extends('templates.base')
@section('title','Curso')
@section('subtitle','Crear')
@section('content')
    @include('templates.messages')

    <div class="row p-2">
        <div class="col-lg-12">
            <form action="{{ route('courses.store') }}" method="POST">
                @csrf
                <div class="row col-lg-12">
                    <label for="title">Titulo:</label>
                    <input type="text" class="form-control" name="title" id="title" required>
                </div>
                <div class="row col-lg-12">
                    <label for="description">Descripcion:</label>
                    <input type="text" class="form-control" name="description" id="description">
                </div>
                <div class="row col-lg-12">
                    <label for="price">Precio:</label>
                    <input type="number" class="form-control" name="price" id="price" required>
                </div>
                <div class="row col-lg-12">
                     <label for="instructor_id">Instructor</label>
                        <select name="instructor_id" id="instructor_id" class="form-control">
                            <option value="">Seleccione</option>
                                @foreach ($instructors as $instructor)
                                <option value="{{ $instructor['id'] }}"
                                 @if (old('instructor_id') == $instructor['id']) selected @endif>
                                    {{ $instructor['name'] }}
                                </option>
                            @endforeach
                        </select>
                </div>
                <div class="row col-lg-12">
                     <label for="category_id">Categoria</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Seleccione</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category['id'] }}"
                                 @if (old('category_id') == $instructor['id']) selected @endif>
                                    {{ $category['name'] }}
                                </option>
                            @endforeach
                        </select>
                </div>

                <div class="row col-lg-12">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-success btn-block btn-fill">Guardar</button>
                    </div>
                    <div class="col-lg-6">
                        <a href="{{ route('courses.index') }}" class="btn btn-secondary btn-block btn-fill">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection    