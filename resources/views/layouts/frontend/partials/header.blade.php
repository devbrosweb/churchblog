<!-- Header -->
<header class="w3-container w3-center w3-padding-32 w3-deep-orange">
    <h1><b>IGLESIA JEHOVA REINA</b></h1>
    <p>Bienvenido al blog de la <span class="" style="font-style: italic">
            Iglesia Jehova Reina</span></p>

    @guest
    @else
            <a class="w3-btn" href="
            @if(Auth::user()->role_id == 1)
            {{ route('admin.dashboard') }}
            @else
            {{ route('author.dashboard') }}
            @endif
                    ">
                {{ Auth::user()->name }}
        </a>
    @endguest
</header>
