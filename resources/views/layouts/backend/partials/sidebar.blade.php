<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{ asset('assets/backend/images/user.png') }}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}</div>
            <div class="email">{{ Auth::user()->email }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li>
                        <a class="" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i>Salir
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>

                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            @if(Request::is('admin*'))
                <li class="header">NAVEGACION PRINCIPAL</li>
                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/posts*') ? 'active' : '' }}">
                    <a href="{{ route('admin.posts.index') }}">
                        <i class="material-icons">library_books</i>
                        <span>Posts</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/pendientes/posts') ? 'active' : '' }}">
                    <a href="{{ route('admin.posts.pending') }}">
                        <i class="material-icons">library_books</i>
                        <span>Posts Pendientes</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/categorias*') ? 'active' : '' }}">
                    <a href="{{ route('admin.categorias.index') }}">
                        <i class="material-icons">apps</i>
                        <span>Categorias</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/etiquetas*') ? 'active' : '' }}">
                    <a href="{{ route('admin.etiquetas.index') }}">
                        <i class="material-icons">label</i>
                        <span>Etiquetas</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/subscribers*') ? 'active' : '' }}">
                    <a href="{{ route('admin.subscribers.index') }}">
                        <i class="material-icons">subscriptions</i>
                        <span>Suscriptores</span>
                    </a>
                </li>
                <li class="header">sistema</li>
                <li class="">
                    <a class="" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i>
                        <span>Salir</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>

                </li>
            @endif
            @if(Request::is('author*'))
                    <li class="header">NAVEGACION PRINCIPAL</li>
                    <li class="{{ Request::is('author/dashboard') ? 'active' : '' }}">
                        <a href="{{ route('author.dashboard') }}">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('author/posts*') ? 'active' : '' }}">
                        <a href="{{ route('author.posts.index') }}">
                            <i class="material-icons">library_books</i>
                            <span>Posts</span>
                        </a>
                    </li>
                    <li class="header">sistema</li>
                    <li class="">
                        <a class="" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i>
                            <span>Salir</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>

                    </li>
            @endif



        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2018 <a href="javascript:void(0);">devbrosweb</a>
        </div>

    </div>
    <!-- #Footer -->
</aside>