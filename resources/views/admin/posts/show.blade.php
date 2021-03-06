@extends('layouts.backend.app')

@section('title', $title)

@push('css')
    <style>
        .mx-1{
            margin: 0 1rem !important;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <a href="{{ route('admin.posts.index') }}" class="btn btn-danger waves-effect">VOLVER</a>
        @if($post->is_approved() == false)
            <button type="button" class="btn btn-success waves-effect pull-right"
                    onclick="approvePosts({{ $post->id }})">
                <i class="material-icons">done</i>
                <span>APROBAR</span>
            </button>
            <form method="post" action="{{ route('admin.posts.approve', $post) }}" id="form-approve">
                @csrf
                @method('PUT')
            </form>
        @else
            <button type="button" class="btn btn-success pull-right" disabled>
                <i class="material-icons">done</i>
                <span>APROBADO</span>
            </button>
        @endif
        <br>
        <br>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            {{ $post->title }}
                            <small>Escrito por: <strong><a href="">{{ $post->user->name }}, </a></strong>
                            en {{ $post->created_at->toFormattedDateString() }}
                            </small>
                        </h2>
                    </div>
                    <div class="body">
                        {!! $post->body !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-cyan">
                        <h2>
                            Categorias
                        </h2>
                    </div>
                    <div class="body">
                        @foreach($post->categories as $category)
                            <span class="label bg-cyan" style="font-size: 14px">{{ $category->name }}</span>
                        @endforeach

                    </div>
                </div>
                <div class="card">
                    <div class="header bg-green">
                        <h2>
                            Etiquetas
                        </h2>
                    </div>
                    <div class="body">
                        @foreach($post->tags as $tag)
                            <span class="label bg-green" style="font-size: 14px">{{ $tag->name }}</span>
                        @endforeach

                    </div>
                </div>
                <div class="card">
                    <div class="header bg-amber">
                        <h2>
                            Imagen Subida
                        </h2>
                    </div>
                    <div class="body">
                        <img class="img-responsive thumbnail" src="{{ \Illuminate\Support\Facades\Storage::disk('public')
                        ->url('posts/'.$post->image) }}" alt="{{ $post->name }}">
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
    </div>

@endsection

@push('js')
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.25.0/dist/sweetalert2.all.min.js"></script>

    <script>

        function approvePosts(id){
            const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger mx-1',
                buttonsStyling: false,
            })

            swalWithBootstrapButtons({
                title: 'Estas Seguro?',
                text: "esta aprobando este post!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, quiero aprobarlo!',
                cancelButtonText: 'No, cancelar!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('form-approve').submit()
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons(
                        'Cancelado',
                        'El post aún esta pendiente:)',
                        'info'
                    )
                }
            })
        }

    </script>

@endpush