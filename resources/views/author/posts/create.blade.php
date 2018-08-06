@extends('layouts.backend.app')

@section('title', $title)

@push('css')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <form action="{{ route('author.posts.store')}}"
              method="POST" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Crear Nueva Post
                        </h2>
                    </div>
                    <div class="body">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" name="title" id="name" class="form-control"
                                       value="{{ old('title') }}">
                                <label class="form-label">Título de post</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Subir imagen</label>
                            <input type="file" name="image" id="image">
                        </div>
                        <div class="form-group">
                            <input type="checkbox" class="filled-in" id="published" name="status" value="1 ">
                            <label for="published">Publicado</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Categorias & Etiquetas
                        </h2>
                    </div>
                    <div class="body">
                        <div class="form-group form-float">
                            <div class="form-line {{ $errors->has('categories') ? 'focused error' : ''}}">
                                <label for="category">Selecciona las categorias</label>
                                <select name="categories[]" id="category" class="form-control
                                show-tick" data-live-search="true" multiple>
                                @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line {{ $errors->has('tags') ? 'focused error' : ''}}">
                                <label for="etiqueta">Selecciona las etiquetas</label>
                                <select name="tags[]" id="etiqueta" class="form-control
                                show-tick" data-live-search="true" multiple>
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <a href="{{ route('author.posts.index') }}" class="btn btn-danger m-t-15 waves-effect">
                                Volver</a>
                        <button type="submit" class="btn btn-info m-t-15 waves-effect">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Contenido post
                        </h2>
                    </div>
                    <div class="body">
                        <textarea name="body" id="tinymce" >
                            {{ old('body') }}
                        </textarea>
                    </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->

    </div>

@endsection

@push('js')
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('assets/backend/plugins/tinymce/tinymce.js') }}"></script>
    <script>
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('assets/backend/plugins/tinymce') }}';
        });
    </script>

@endpush