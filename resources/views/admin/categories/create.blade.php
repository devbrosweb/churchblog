@extends('layouts.backend.app')

@section('title', $title)

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
                <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Crear Nueva Categoria
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.categorias.store')}}"
                              method="POST" enctype="multipart/form-data"
                                            >
                            @csrf

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="name" id="name" class="form-control"
                                           value="{{ old('name') }}">
                                    <label class="form-label">Nombre de categoria</label>
                                </div>
                            </div>
                            <div class="from-group">
                                <input type="file" name="image">
                            </div>

                            <a href="{{ route('admin.categorias.index') }}" class="btn btn-danger m-t-15 waves-effect">
                                Volver</a>
                            <button type="submit" class="btn btn-info m-t-15 waves-effect">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->

    </div>

@endsection

@push('js')

@endpush