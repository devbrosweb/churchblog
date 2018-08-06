@extends('layouts.frontend.app')

@section('title', '')

@push('css')

@endpush

@section('content')
    <!-- w3-content defines a container for fixed size centered content,
and is wrapped around the whole page content, except for the footer in this example -->
    <div class="w3-content" style="max-width:1600px">

        <!-- Grid -->
        <div class="w3-row">

            <!-- Blog entries -->
            <div class="w3-col l8 s12">
                <div class="w3-row-padding w3-margin">
                    <h2 class="w3-padding-32 ">Ultimos Posts Creados</h2>
                @foreach($posts as $post)

                <div class="w3-card-4 w3-col m6 w3-mar w3-white" style="margin-bottom: 36px;">
                    <div class="img-blog">
                        <img src="{{ Storage::disk('public')->url('posts/'.$post->image) }}" alt="Nature" style="width:100%">
                    </div>
                    <div class="w3-container">
                        <h3><b>{{ $post->title }}</b></h3>
                        <h5 style="padding: 16px 0;"><strong>Escrito por: </strong>{{ $post->user->name }}, <strong>Publicado: </strong><span class="w3-opacity">{{ $post->created_at->toFormattedDateString() }}</span></h5>
                    </div>

                    <div class="w3-container">
                        <p>{!! str_limit($post->body, $limit = 150) !!} </p>
                        <div class="w3-row">
                            <div class="w3-col trans">
                                <p><button class="w3-button w3-hover-deep-orange trans w3-padding-large w3-white w3-border">
                                        <b>LEER MAS  »</b>
                                    </button></p>
                            </div>
                            <div class="w3-col w3-hide-small">
                                <p>
                                <span class="w3-padding">
                                    <i class="fa fa-heart fa-2x" style="padding-right: 5px;" aria-hidden="true"></i>
                                    <span class="">0</span>
                                </span>
                                <span class="w3-padding">
                                    <i class="fa fa-eye fa-2x" style="padding-right: 5px;" aria-hidden="true"></i>
                                    <span class="">0</span>
                                </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
                </div>

                <!-- END BLOG ENTRIES -->
            </div>

            @include('layouts.frontend.partials.sidebar')

            <!-- END GRID -->
        </div><br>

        <!-- END w3-content -->
    </div>
@endsection

@push('js')

@endpush