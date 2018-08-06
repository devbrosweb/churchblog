@extends('layouts.backend.app')

@section('title', $title)

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

    <style>
        .mx-1{
            margin: 0 1rem !important;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <a class="btn btn-info waves-effect" href="{{ route('author.posts.create') }}">
                <i class="material-icons">add</i>
                <sp>Crear Nueva Post</sp>
            </a>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Todas los Posts
                            <span class="badge bg-blue">{{ $posts->count() }}</span>
                        </h2>

                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Título</th>
                                    <th>Autor</th>
                                    <th><i class="material-icons">visibility</i></th>
                                    <th>Aprobado</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Acción</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Título</th>
                                    <th>Autor</th>
                                    <th><i class="material-icons">visibility</i></th>
                                    <th>Aprobado</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Acción</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($posts as $key => $post)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ str_limit($post->title, 10)  }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>{{ $post->view_count }}</td>
                                        <td>
                                            @if($post->is_approved() == true)
                                                <span class="badge bg-blue">Aprobado</span>
                                            @else
                                                <span class="badge bg-pink">Pendiente</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($post->is_published() == true)
                                                <span class="badge bg-blue">Publicado</span>
                                            @else
                                                <span class="badge bg-pink">Pendiente</span>
                                            @endif
                                        </td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>
                                            <a href="{{ route('author.posts.show', $post) }}"
                                               class="btn btn-success  waves-effect">
                                                <i class="material-icons">visibility</i>

                                            </a>
                                            <a href="{{ route('author.posts.edit', $post) }}"
                                                class="btn btn-info  waves-effect">
                                                <i class="material-icons">edit</i>

                                            </a>
                                            <button onclick="deletePost({{ $post->id }})"
                                                    class="btn btn-danger waves-effect" type="button">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form style="none;" id="form-tag-{{ $post->id }}"
                                                  method="POST"
                                                  action="{{ route('author.posts.destroy', $post) }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
@endsection

@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }} "></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }} "></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }} "></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }} "></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }} "></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }} "></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }} "></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }} "></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }} "></script>

    <!-- Custom Js -->
    <script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }} "></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.25.0/dist/sweetalert2.all.min.js"></script>

    <script>

        function deletePost(id){
            const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger mx-1',
                buttonsStyling: false,
            })

            swalWithBootstrapButtons({
                title: 'Estas Seguro?',
                text: "No podras revertirlo!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, borralo!',
                cancelButtonText: 'No, cancelar!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('form-tag-'+id).submit()
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons(
                        'Cancelado',
                        'Tu archivo esta seguro :)',
                        'error'
                    )
                }
            })
        }

    </script>

@endpush