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
            <a class="btn btn-info waves-effect" href="{{ route('admin.categorias.create') }}">
                <i class="material-icons">add</i>
                <sp>Crear Nueva Categoria</sp>
            </a>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Todas las Categorias
                            <span class="badge bg-blue">{{ $categories->count() }}</span>
                        </h2>

                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Cantidad Posts</th>
                                    <th>Fecha</th>
                                    <th>Fecha Actualización</th>
                                    <th>Acción</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Cantidad Posts</th>
                                    <th>Fecha</th>
                                    <th>Fecha Actualización</th>
                                    <th>Acción</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($categories as $key => $category)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->posts->count() }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>{{ $category->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.categorias.edit', ['category' => $category]) }}"
                                                class="btn btn-info waves-effect"
                                            >
                                                <i class="material-icons">edit</i>

                                            </a>
                                            <button onclick="deleteCategory({{ $category->id }})" class="btn btn-danger waves-effect" type="button">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form style="none" id="form-tag-{{ $category->id }}"
                                                  method="POST"
                                                  action="{{ route('admin.categorias.destroy', $category) }}">
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

        function deleteCategory(id){
            const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger  mx-1',
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